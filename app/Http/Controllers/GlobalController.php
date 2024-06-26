<?php

namespace App\Http\Controllers;

use App\Models\ChatGroupConversation;
use App\Models\Notice;

class GlobalController extends Controller
{
    public function checkWeekend($weekday)
    {
        return isWeekend($weekday);
    }

    public function pinnedAnnouncement()
    {
        return Notice::where('pinned', 1)->where('status', 'public')->latest()->get(['id', 'title']);
    }

    public function fetchAttachments($group_id)
    {
        return ChatGroupConversation::select('id', 'chat_group_id', 'file', 'file_type')
            ->where('chat_group_id', $group_id)
            ->whereNotNull('file')
            ->latest()
            ->get();
    }
}
