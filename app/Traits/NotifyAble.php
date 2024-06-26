<?php

namespace App\Traits;

trait NotifyAble
{
    public function flashSuccess($message = null)
    {
        if (! $message) {
            session()->flash('success', 'Succeeded');
        } else {
            session()->flash('success', $message);
        }
    }

    public function flashError($message = null)
    {
        if (! $message) {
            session()->flash('error', 'Failed');
        } else {
            session()->flash('error', $message);
        }
    }

    public function flashWarning($message = null)
    {
        if (! $message) {
            session()->flash('warning', 'Warning');
        } else {
            session()->flash('warning', $message);
        }
    }
}
