<?php

namespace App\Services;

class ParentChildrenService
{
    public function getChildren(): array
    {
        $user = authUser();
        if ($user) {
            $child_ids = $user->childrens()->get()->map(function ($q) {
                return $q->id;
            })->toArray();
        }

        return $child_ids ?? [];
    }
}
