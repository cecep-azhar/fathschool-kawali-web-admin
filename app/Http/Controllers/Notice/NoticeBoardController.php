<?php

namespace App\Http\Controllers\Notice;

use App\Actions\File\FileDelete;
use App\Actions\File\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\User;
use App\Services\Notice\NoticeBoardService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NoticeBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(! userCan('notice-board.index'), 403);

        $user = authUser();
        $array = ['Student', 'Teacher', 'Parent', 'Accountant'];

        if (in_array($user->role, $array)) {

            $data = (new NoticeBoardService)->otherRoleNoticeBoardPage();

            return Inertia::render('NoticeBoard', $data);
        } else {

            // For Admin & Others role
            $data = (new NoticeBoardService)->index();

            return Inertia::render('Admin/Announcement/Index', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(! userCan('notice-board.create'), 403);

        $request->validate([
            'title' => 'required',
            'file' => 'required|image',
            'description' => 'required',
            'status' => 'required',
            'roles' => 'required',
        ]);

        if ($request->hasFile('file')) {
            $url = FileUpload::uploadImage($request->file, 'notice');
        }

        Notice::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'attachment' => $url ?? '',
            'description' => $request->description,
            'status' => $request->status,
            'roles' => $request->roles,
        ]);

        $this->flashSuccess('Notice created');

        if ($request->roles == 'Teacher') {
            $teachers_fcm_token = User::where('role', 'Teacher')->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
            foreach ($teachers_fcm_token as $token) {
                Controller::sendNotificationToUser($token, 'Pemberitahuan', 'Ada pengumuman baru');
            }
        }else if ($request->roles == 'Student') {
            $students_fcm_token = User::where('role', 'Student')->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
            foreach ($students_fcm_token as $token) {
                Controller::sendNotificationToUser($token, 'Pemberitahuan', 'Ada pengumuman baru');
            }
        }

        return redirect()->route('notice-board.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Notice $notice_board)
    {
        abort_if(! userCan('notice-board.show'), 403);

        $notice_board->load('user');

        $comments = $notice_board->comments()
            ->with('user:id,name,username,profile_photo_path', 'replies.user:id,name,username,profile_photo_path')->latest()->paginate(5)->onEachSide(-1);

        return inertia('Admin/Announcement/Show', [
            'notice_board' => $notice_board,
            'comments' => $comments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Notice $notice_board)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notice $notice_board)
    {
        abort_if(! userCan('notice-board.edit'), 403);

        $request->validate([
            'title' => 'required',
            'attachment' => 'nullable|image',
            'description' => 'required',
            'status' => 'required',
        ]);

        if ($request->hasFile('attachment')) {
            $url = FileUpload::uploadImage($request->attachment, 'notice');
            FileDelete::deleteImage($notice_board->attachment);
        }

        $notice_board->update([
            'title' => $request->title,
            'attachment' => $url ?? $notice_board->attachment,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        $this->flashSuccess('Notice updated');

        return redirect()->route('notice-board.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notice $notice_board)
    {
        abort_if(! userCan('notice-board.destroy'), 403);

        FileDelete::deleteImage($notice_board->attachment);
        $notice_board->delete();

        $this->flashSuccess('Notice deleted');

        return redirect()->route('notice-board.index');
    }

    /**
     * Pin the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pin(Notice $notice_board)
    {
        if ($notice_board->pinned) {
            $notice_board->update(['pinned' => 0]);
            $message = 'Notice Unpinned';
        } else {
            $notice_board->update(['pinned' => 1]);
            $message = 'Notice Pinned';
        }

        $this->flashSuccess($message);

        return back();
    }
}
