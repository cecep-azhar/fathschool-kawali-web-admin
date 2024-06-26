<?php

namespace App\Traits;

use App\Models\User;

trait CheckParentOrChildren
{
    public function checkUser(): object
    {
        if (authUser()->role == 'Parent') { // if parent access
            $visited_children = session()->get('children_view');
            $user = User::FindOrFail($visited_children);
        } else { // if student access
            $user = authUser();
        }

        return $user;
    }
}
