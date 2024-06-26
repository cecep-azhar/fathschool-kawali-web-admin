<?php

namespace App\Services\Notice;

use App\Models\Notice;

class NoticeBoardService
{
    public function index(): array
    {
        $notices_query = Notice::latest()->with('user')
            ->withCount('comments');

        if (request()->has('id') && request()->id != null) {
            $notices_query->where('id', request()->id);
        }

        $data['notices'] = $notices_query->paginate(20)->withQueryString();

        return $data;
    }

    public function otherRoleNoticeBoardPage(): array
    {
        $data['notices'] = Notice::latest()->withCount('comments')->public()
        // ->with('user:id,name,username,profile_photo_path', 'comments.user:id,name,username,profile_photo_path', 'comments.replies.user:id,name,profile_photo_path')
            ->paginate(20);

        return $data;
    }
}
