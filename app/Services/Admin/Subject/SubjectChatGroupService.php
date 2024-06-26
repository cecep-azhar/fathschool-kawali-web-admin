<?php

namespace App\Services\Admin\Subject;

class SubjectChatGroupService
{
    public function subjectChatGroupStore(object $subject): void
    {
        $exist = $subject->chat_group;
        if (! $exist) {
            $subject->chat_group()->create([
                'name' => $subject->name,
                'description' => $subject->name,
            ]);
        }
    }

    public function subjectChatGroupUpdate(object $subject): void
    {
        $exist = $subject->chat_group;
        if (! $exist) {
            $subject->chat_group()->create([
                'name' => $subject->name,
                'description' => $subject->name,
            ]);
        } else {
            $subject->chat_group()->update([
                'name' => $subject->name,
                'description' => $subject->name,
            ]);
        }
    }
}
