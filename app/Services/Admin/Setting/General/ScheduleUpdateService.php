<?php

namespace App\Services\Admin\Setting\General;

use App\Models\WorkingDays;

class ScheduleUpdateService
{
    public function update(object $request)
    {
        return WorkingDays::first()->update([
            'monday' => $request->monday ? true : false,
            'tuesday' => $request->tuesday ? true : false,
            'wednesday' => $request->wednesday ? true : false,
            'thursday' => $request->thursday ? true : false,
            'friday' => $request->friday ? true : false,
            'saturday' => $request->saturday ? true : false,
            'sunday' => $request->sunday ? true : false,
        ]);
    }
}
