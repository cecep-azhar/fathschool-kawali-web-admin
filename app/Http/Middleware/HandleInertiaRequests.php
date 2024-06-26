<?php

namespace App\Http\Middleware;

use App\Models\AdmissionRequest;
use App\Models\Currency;
use App\Models\Language;
use App\Models\Leave;
use App\Models\Onboarding;
use App\Models\Setting;
use App\Models\SocialLink;
use App\Models\User;
use App\Services\ParentChildrenService;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     */
    public function share(Request $request): array
    {
        // children get under a parent
        $children_ids = (new ParentChildrenService)->getChildren();
        $children = User::whereIn('id', $children_ids)
            ->with(['profile:id,user_id,roll_no', 'profile.user:id'])
            ->get();

        $onboarding_contents = [];

        $authUser = authUser();
        if ($authUser && !$authUser->tour_completed) {
            $onboarding_contents = Onboarding::select('menu_slug', 'title', 'description')->get();
        }

        $auth = $authUser ? $authUser : '';
        $auth_permissions = $authUser ? $authUser->getAllPermissions()->map(function ($q) {
            return $q->name;
        }) : null;
        $kids = $authUser ? $children : null;

        $setting = Setting::first();

        if (config('templatecookie.currency')) {
            $currency = Currency::whereCode(config('templatecookie.currency'))->first();
        }
        
        if (session('myCurrency')) {
            $currency = session('myCurrency');
        }

        if ($currency) {
            $default_currency = $currency->code;
            $default_currency_symbol = $currency->symbol;
        }else{
            $default_currency = 'USD';
            $default_currency_symbol = "$";
        }
        $socialLinks = SocialLink::active()->latest()->get(['name', 'url', 'icon']);

        return array_merge(parent::share($request), [
            'auth' => $auth,
            'auth_permissions' => $auth_permissions,
            'kids' => $kids,

            // Settings
            'setting' => $setting,

            'app_name' => config('app.name'),
            'app_version' => env('APP_VERSION'),
            'start_day_of_week' => config('templatecookie.start_day_of_week'),
            'currency_format' => config('templatecookie.currency_format'),
            'date_format' => config('templatecookie.date_format'),

            // Language
            'locale' => function () {
                return app()->getLocale();
            },
            'languages' => Language::all(),
            'all_locals' => Language::select('id', 'name', 'code', 'direction')->get(),
            'language' => function () {
                return translations(
                    base_path('lang/' . app()->getLocale() . '.json')
                );
            },
            // Currency

            // 'default_currency' => config('templatecookie.currency'),
            'default_currency' => $default_currency,
            'default_currency_symbol' => $default_currency_symbol,
            'all_currencies' => Currency::where('status', 1)->get(),
            'currency_conversion_rate' => currencyConversionRate(),

            // Notification
            'un_read_notification_amount' => $authUser ? $authUser->unreadNotifications()->count() : '',
            'notifications' => $authUser ? $authUser->notifications()->latest()->take(5)->get() : '',
            'pending_leave_count' => Leave::where('status', 'pending')->count(),

            // Toast Notification
            'success' => Session()->get('success') ?: '',
            'warning' => Session()->get('warning') ?: '',
            'status' => Session()->get('status') ?: '',

            'admission_request_count' => AdmissionRequest::where('isAccept', false)->count(),
            'social_links' => $socialLinks,
            'onboarding_contents' => $onboarding_contents,
        ]);
    }
}
