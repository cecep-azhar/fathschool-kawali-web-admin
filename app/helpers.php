<?php

use App\Models\AdmissionFormField;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\WorkingDays;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use msztorc\LaravelEnv\Env;

use App\Models\Currency;

if (!function_exists('translations')) {
    function translations($json)
    {
        if (!file_exists($json)) {
            return [];
        }

        return json_decode(file_get_contents($json), true);
    }
}

/**
 * user permission check
 *
 * @param  string  $permission
 * @return bool
 */
if (!function_exists('userCan')) {
    function userCan($permission)
    {
        return authUser()->can($permission);
    }
}

/**
 * setting data get by specific column name
 *
 * @param  string  $name
 * @return bool
 */
if (!function_exists('setting')) {
    function setting($fields = null, $append = false)
    {
        $cacheKey = 'settings:' . md5(serialize(func_get_args()));

        $data = cache()->remember($cacheKey, 60, function () use ($fields, $append) {
            if ($fields) {
                $type = gettype($fields);

                if ($type == 'string') {
                    $data = $append ? Setting::first($fields) : Setting::value($fields);
                } elseif ($type == 'array') {
                    $data = Setting::first($fields);
                }
            } else {
                $data = Setting::first();
            }

            if ($append) {
                $data = $data->makeHidden(['dark_logo_url', 'light_logo_url', 'favicon_icon_url']);
            }

            return $data;
        });

        return $data;
    }
}

/**
 * String slug generator
 *
 * @param  string  $permission
 * @return bool
 */
if (!function_exists('strSlug')) {
    function strSlug(string $string): string
    {
        return Str::slug($string);
    }
}

/**
 * Specific Date Format
 *
 * @param  string  $date
 * @param  string  $format
 * @return string
 */
if (!function_exists('customDateFormat')) {
    function customDateFormat(string $date, string $format): string
    {
        $formatted_date = date($format, strtotime($date));

        return $formatted_date;
    }
}

/**
 * Update env data
 *
 * @param  string  $key
 * @param  string  $value
 * @return void
 */
if (!function_exists('setEnv')) {
    function setEnv(string $key, string $value)
    {
        if ($key && $value) {
            $env = new Env;
            $env->setValue($key, $value);
        }

        if (file_exists(App::getCachedConfigPath())) {
            Artisan::call('config:clear');
            Artisan::call('config:cache');
        }
    }
}

/**
 * Check SmpT is fullFill
 */
if (!function_exists('checkMailConfig')) {
    function checkMailConfig()
    {
        $status = config('mail.mailers.smtp.transport') && config('mail.mailers.smtp.host') && config('mail.mailers.smtp.port') && config('mail.mailers.smtp.username') && config('mail.mailers.smtp.password') && config('mail.mailers.smtp.encryption') && config('mail.from.address') && config('mail.from.name');

        !$status ? session()->flash('warning', 'Mail not sent for the reason of incomplete mail configuration') : '';

        return $status ? 1 : 0;
    }
}

/**
 * Check Zoom Meet Info is fullFill
 */
if (!function_exists('zMeetConfig')) {
    function zMeetConfig()
    {
        $status = env('ZOOM_API_URL') && env('ZOOM_ACCOUNT_ID') && env('ZOOM_CLIENT_ID') && env('ZOOM_CLIENT_SECRET');

        !$status ? session()->flash('warning', 'incomplete zoom meeting configuration') : '';

        return $status ? 1 : 0;
    }
}

/**
 * Format time and date
 */
if (!function_exists('formatTime')) {
    function formatTime($date, $format = null, $concat = null)
    {
        $date_format = 'F d, Y';

        if (!$format) {
            $app_format = config('templatecookie.date_format');

            $all_format = [
                'd_m_Y' => 'd-m-Y',
                'd_M_Y' => 'd-M-Y',
                'd__m__Y' => 'd/m/Y',
                'm_d_Y' => 'm-d-Y',
                'm__d__Y' => 'm/d/Y',
                'Y__m__d' => 'Y/m/d',
            ];

            if ($app_format) { //if $app_format is not empty
                $date_format = $all_format[$app_format];
            } else {
                $date_format = $format;
            }
        } else {
            $date_format = $format;
        }

        if ($concat) {
            $date_format = $date_format . ' ' . $concat;
        }

        return Carbon::parse($date)->format($date_format) ?? $date;
    }
}

/**
 * @param  string  $path
 * Make directory
 */
if (!function_exists('checkDirectory')) {
    function checkDirectory($path)
    {
        if (!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        return true;
    }
}

/**
 * @param  string  $path
 * File Moving
 */
if (!function_exists('fileMove')) {
    function fileMove($from, $to, $folder = null)
    {
        if ($folder) {
            checkDirectory($folder);
        }
        if ($from && $to) {
            File::move($from, $to);
        }

        return true;
    }
}

if (!function_exists('checkMailConfig')) {
    function checkMailConfig()
    {
        $status = config('mail.mailers.smtp.transport') && config('mail.mailers.smtp.host') && config('mail.mailers.smtp.port') && config('mail.mailers.smtp.username') && config('mail.mailers.smtp.password') && config('mail.mailers.smtp.encryption') && config('mail.from.address') && config('mail.from.name');

        return $status ? 1 : 0;
    }
}

if (!function_exists('isWeekend')) {
    function isWeekend($selected_weekday_no = null)
    {
        $schedule = WorkingDays::first();

        $weekdays = [
            '0' => 'Sunday',
            '1' => 'Monday',
            '2' => 'Tuesday',
            '3' => 'Wednesday',
            '4' => 'Thursday',
            '5' => 'Friday',
            '6' => 'Saturday',
        ];

        $weekends = [];

        foreach ($weekdays as $key => $weekday) {
            $day = Str::lower($weekday);

            if (!$schedule->$day) {
                $weekends[] = $key;
            }
        }

        foreach ($weekends as $weekend) {
            if ($selected_weekday_no == $weekend) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('idGenerate')) {
    function idGenerate($model = null, $trow = 'student_id', $length = 5, $prefix = 'STD')
    {
        if (!$model) {
            $data = UserProfile::whereNotNull('student_id')->orderBy('id', 'desc')->first();
        } else {
            $data = $model::orderBy('id', 'desc')->first();
        }

        if (!$data) {
            $og_length = $length;
            $last_number = '';
        } else {
            $code = substr($data->$trow, strlen($prefix) + 1);
            $actual_last_number = ($code / 1) * 1;
            $increment_last_number = ((int) $actual_last_number) + 1;
            $last_number_length = strlen($increment_last_number);
            $og_length = $length - $last_number_length;
            $last_number = $increment_last_number;
        }

        $zeros = '';
        for ($i = 0; $i < $og_length; $i++) {
            $zeros .= '0';
        }

        return $prefix . '-' . $zeros . $last_number;
    }
}

if (!function_exists('authUser')) {
    function authUser()
    {
        return auth()->user();
    }
}

if (!function_exists('currencyFormat')) {
    function currencyFormat($amount = null)
    {
        if ($amount) {
            $app_currency_format = config('templatecookie.currency_format');

            $format = [
                '12345678.00' => number_format($amount, 2, '.', ''),
                '12,345,678.00' => number_format($amount),
                '1,23,45,678.00' => number_format($amount, 2, '.', ','),
                '12.345.678.00' => number_format($amount, 2, '.', '.'),
                '12.345.678,00' => number_format($amount, 2, ',', '.'),
            ];

            if ($app_currency_format) { // if $app_currency_format is not empty
                return $format[$app_currency_format];
            } else {
                return 0;
            }
        }

        return 0;
    }
}

/**
 * Check Admission column is enabled
 *
 * @param  string  $field_name
 * @return bool
 */
if (!function_exists('admissionFieldIsActive')) {
    function admissionFieldIsActive($field_name = null): bool
    {
        $field_fetch = AdmissionFormField::where('name', $field_name)->first();
        if ($field_fetch) {
            return $field_fetch->status;
        } else {
            return false;
        }
    }
}

/**
 * Currency exchange
 *
 * @param $amount
 * @param $to
 * @param $from
 * @param $round
 * @return number
 */
if (!function_exists('currencyConversion')) {
    function currencyConversion($amount, $to = null, $from = 'USD', $round = 2)
    {
        $to = config('templatecookie.currency');
        if ($amount) {

            $fromRate = Currency::where('code',$from)?->first()?->rate ?? 1;
            $toRate = Currency::whereCode($to)?->first()?->rate ?? 1;
            $rate = $fromRate / $toRate;
            return round($amount / $rate, 2);
        }

        return 0;
    }
}



if (!function_exists('currencyConversionRate')) {
    function currencyConversionRate()
    {
        return app('currency')->currencyConversionRate();
    }
}

function domPdfImageUrl($path)
{
    if ($path) {

        $image = base64_encode(file_get_contents($path));

        return "data:image/png;base64,$image";
    }

    return false;
}
