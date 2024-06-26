<?php

namespace App\Http\Controllers;

use App\Events\GroupChatMessage;
use App\Models\ChatGroup;
use App\Models\ChatGroupConversation;
use App\Models\Subject;
use App\Models\User;
use App\Notifications\Student\SendNewMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GroupChatController extends Controller
{
    public function index(Request $request)
    {
        abort_if(! userCan('group.chat'), 403);

        $user = authUser();
        if ($user->role == 'Student') {
            $student_classes = $user->courses()->get()->map(function ($q) {
                return $q->course_id;
            });
            $subs_ids = Subject::whereIn('course_id', $student_classes)->get()->map(function ($sub) {
                return $sub->id;
            });
        } else {
            $subs_ids = $user->subjects->map(function ($q) {
                return $q->subject_id;
            });
        }

        $data['groups'] = ChatGroup::whereIn('subject_id', $subs_ids)
            ->with(['users', 'subject.course'])
            ->when($request->keyword, function ($query) use ($request) {
                $query->where('name', 'Like', '%'.$request->keyword.'%');
            })
            ->get()
            ->map(function ($group) {
                $chat_group_conversation = ChatGroupConversation::where('chat_group_id', $group->id)->latest('id')->first();

                $group->last_messages = $chat_group_conversation ? $chat_group_conversation->message ?? 'file' : 'No Message Found!';
                $group->last_messages_created_time = $chat_group_conversation ? formatTime($chat_group_conversation->created_at, 'H:i A') : '-';

                return $group;
            });
        $data['request'] = $request;

        return inertia('GroupChat/Index', $data);
    }

    public function getGroupMessages($group_id)
    {
        abort_if(! userCan('group.chat'), 403);

        $conversations = ChatGroupConversation::with('sender:id,name')
            ->where('chat_group_id', $group_id)
            ->latest()
            ->get();

        return [
            'conversations' => array_reverse($conversations->toArray()),
        ];
    }

    public function storeMessage(Request $request)
    {
        abort_if(! userCan('group.chat'), 403);

        $request->validate([
            'chat_group_id' => 'required|exists:chat_groups,id',
        ]);

        $sender = authUser();
        $message = ChatGroupConversation::create([
            'chat_group_id' => $request->chat_group_id,
            'sender_user_id' => $sender->id,
            'message' => $request->message ?? null,
        ]);

        // file upload
        if (session('upload_filename') && session('upload_filepath') && session('upload_filetype')) {
            $file_name = session('upload_filename');
            $file_path = session('upload_filepath');
            $file_type = session('upload_filetype');

            $final_path = public_path('/uploads/chat/'.$file_name);
            $folder_path = public_path('uploads/chat');

            fileMove(public_path($file_path), $final_path, $folder_path);

            $message->update(['file' => 'uploads/chat/'.$file_name, 'file_type' => $file_type]);
            $this->sessionForget();
        }

        $message->load('sender:id,name');

        broadcast(new GroupChatMessage($message))->toOthers();

        // send message to all group students
        if ($sender->role == 'Teacher') {
            $chat_group = ChatGroup::select('id')->where('id', $request->chat_group_id)->with('groupUsers:id,user_id,chat_group_id')->first();

            foreach ($chat_group->groupUsers as $group_user) {
                $user = User::student()->where('id', $group_user->user_id)->first();
                if ($user) {
                    $user->notify(new SendNewMessageNotification($sender->name));
                }
            }
        }

        return $message->load('sender:id,name');
    }

    public function deleteGroup(ChatGroup $group)
    {
        $group->delete();

        $this->flashSuccess('Leave request submitted');

        return back();
    }

    public function fileUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:25600',
        ], [
            'file.max' => 'You cannot upload more than 25 MB',
        ]);

        $path = public_path().'/uploads/tmp';
        if (! File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $file = $request->file;

        if ($file) {
            $fileName = $file->hashName();
            $file->move('uploads/tmp', $fileName);
            $fullPath = 'uploads/tmp/'.$fileName;
            $file_type = $request->file_type;

            session(['upload_filename' => $fileName]);
            session(['upload_filepath' => $fullPath]);
            session(['upload_filetype' => $file_type]);
        }

        return response()->json([
            'upload_filename' => $fileName,
            'upload_filepath' => $fullPath,
            'upload_filetype' => $file_type,
        ]);
    }

    public function removeUploadFile()
    {
        $file_path = session('upload_filepath');
        @unlink($file_path);
        $this->sessionForget();

        return true;
    }

    /**
     * Forget the sessions
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sessionForget()
    {
        session()->forget('upload_filename');
        session()->forget('upload_filepath');
        session()->forget('upload_filetype');
    }

    public function clearTmpFolder()
    {
        File::cleanDirectory('uploads/tmp');

        $this->flashSuccess('success', 'Temporary folder has been cleared');

        return back();
    }

    public function viewUploadedFile(ChatGroupConversation $chat_group_conversation)
    {
        $file_exists_check = Storage::exists($chat_group_conversation->file);

        if ($file_exists_check) {
            return Storage::download($chat_group_conversation->file);
        }

        $this->flashError('Error', 'File not found');

        return back();
    }
}
