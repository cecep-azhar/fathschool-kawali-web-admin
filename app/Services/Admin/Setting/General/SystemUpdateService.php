<?php

namespace App\Services\Admin\Setting\General;

use App\Models\Language;
use App\Models\Setting;

class SystemUpdateService
{
    public function update(object $request): void
    {
        // Update settings
        setEnv('APP_DEBUG', $request->app_debug_mode == 1 ? 'true' : 'false');
        setEnv('APP_TIMEZONE', $request->timezone);
        setEnv('APP_CURRENCY', $request->currency);
        setEnv('APP_CURRENCY_FORMAT', $request->currency_format);
        setEnv('APP_DEFAULT_LANGUAGE', $request->language);
        setEnv('DATE_FORMAT', $request->date_format);
        setEnv('START_DAY_OF_WEEK', $request->start_day_of_week);

        // set app lang
        $language = Language::where('code', $request->language)->first();
        if ($language) {
            Session()->put('locale', $language->code);
            Session()->put('current_dir', $language->direction);
        }

        $setting = Setting::first();
        if ($setting) {
            $setting->update([
                'app_currency' => $request->currency,
                'over_due_days' => $request->overdue,
            ]);
        }
    }
}
