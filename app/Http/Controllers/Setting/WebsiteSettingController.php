<?php

namespace App\Http\Controllers\Setting;

use App\Actions\File\FileUpload;
use App\Actions\Setting\Currency\CreateCurrency;
use App\Actions\Setting\Currency\UpdateCurrency;
use App\Actions\Setting\SocialLink\CreateSocialLink;
use App\Actions\Setting\SocialLink\UpdateSocialLink;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\BasicSettingUpdateRequest;
use App\Http\Requests\Admin\Setting\SmtpRequest;
use App\Http\Requests\Admin\Setting\SocialLinkCreateRequest;
use App\Http\Requests\Admin\Setting\SocialLinkUpdateRequest;
use App\Http\Requests\CurrencyCreateRequest;
use App\Http\Requests\CurrencyUpdateRequest;
use App\Mail\SmtpTestEmail;
use App\Models\coba;
use App\Models\Currency;
use App\Models\Documentation;
use App\Models\GallerySlider;
use App\Models\LandingVideo;
use App\Models\Language;
use App\Models\Setting;
use App\Models\SocialLink;
use App\Models\Timezone;
use App\Models\WorkingDays;
use App\Services\Admin\Setting\General\BasicSettingUpdateService;
use App\Services\Admin\Setting\General\ScheduleUpdateService;
use App\Services\Admin\Setting\General\SystemUpdateService;
use App\Services\Admin\Setting\Other\RunCommandService;
use App\Services\Admin\Setting\Payment\PaymentUpdateService;
use App\Services\Admin\Setting\Sms\SmsUpdateService;
use App\Traits\NotifyAble;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use msztorc\LaravelEnv\Env;
use Stichoza\GoogleTranslate\GoogleTranslate;

class WebsiteSettingController extends Controller
{
    use NotifyAble;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(! userCan('settings'), 403);

        $data['timezones'] = Timezone::all();
        $data['languages'] = Language::select('id', 'name', 'code')->get();
        $data['currencies'] = Currency::select('id', 'name', 'code')->get();
        $data['system'] = [
            'timezone' => config('app.timezone'),
            'app_debug_mode' => config('app.debug'),
            'language' => config('templatecookie.default_language'),
            'currency' => config('templatecookie.currency'),
            'currency_format' => config('templatecookie.currency_format'),
            'start_day_of_week' => config('templatecookie.start_day_of_week'),
            'date_format' => config('templatecookie.date_format'),
        ];
        $data['working_days'] = WorkingDays::first();
        $data['setting'] = Setting::first();

        return Inertia::render('Admin/Settings/Index', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BasicSettingUpdateRequest $request)
    {
        abort_if(! userCan('settings'), 403);

        (new BasicSettingUpdateService)->update($request);

        $this->flashSuccess('Website basic setting update successful');

        return back();
    }

    /**
     * System Settings Update
     *
     * @return \Illuminate\Http\Response
     */
    public function systemUpdate(Request $request)
    {
        abort_if(! userCan('settings'), 403);

        $request->validate([
            'timezone' => 'required',
            'app_debug_mode' => 'required',
            'language' => 'required',
            'currency' => 'required',
            'overdue' => 'nullable|integer|min:0',
        ]);

        try {
            (new SystemUpdateService)->update($request);

            $this->flashSuccess('System Setting Successfully');

            return back();
        } catch (\Throwable $th) {
            $this->flashError($th->getMessage());

            return back();
        }
    }

    /**
     * Website Settings
     *
     * @return \Illuminate\Http\Response
     */
    public function website(Request $request)
    {
        abort_if(! userCan('settings'), 403);

        $sliders = GallerySlider::all();
        $landings = LandingVideo::all();
        $documentations = Documentation::all();
        $socialLinks = SocialLink::paginate(15)->onEachSide(-1);
        $isDataExist = $landings->isNotEmpty();

        //  dd($documentations);

        return Inertia::render('Admin/Settings/Website', compact('sliders', 'socialLinks', 'landings', 'documentations','isDataExist',));
    }

    /**
     * Website slider delete
     *
     * @return \Illuminate\Http\Response
     */
    public function sliderStore(Request $request)
    {
        $request->validate(['image' => 'required|file|mimes:png,jpg,jpeg|max:5120']);

        if ($request->hasFile('image')) {
            $url = FileUpload::uploadImage($request->image, 'slider');
            GallerySlider::create(['image' => $url]);
        }

        $this->flashSuccess('Slider Image Added Successfully');

        return back();
    }
    public function landingStore(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:500',
        'youtubelink' => 'required|string|max:255',
        'thumbnail' => 'required|file|mimes:png,jpg,jpeg|max:5120'
    ]);

    // Mengecek apakah ada data yang sudah ada di dalam database
    $existingLandingVideo = LandingVideo::first();
    if ($existingLandingVideo) {
        return response()->json(['message' => 'Data sudah ada, Anda hanya dapat memasukkan satu data.'], 400);
    }

    if ($request->hasFile('thumbnail')) {
        $url = FileUpload::uploadImage($request->thumbnail, 'landingvideo');
    } else {
        return response()->json(['message' => 'Thumbnail is required.'], 400);
    }

    $landingVideo = LandingVideo::create([
        'title' => $request->title,
        'description' => $request->description,
        'youtube_link' => $request->youtubelink,
        'thumbnail' => $url
    ]);

    return response()->json($landingVideo, 201);
}

    
public function DocumentationStore(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'youtubelink' => 'required|url',
        'thumbnail' => 'required|file|mimes:png,jpg,jpeg|max:5120'
    ]);

    if ($request->hasFile('thumbnail')) {
        $url = FileUpload::uploadImage($request->thumbnail, 'images');
    }

    Documentation::create([
        'title' => $request->title,
        'description' => $request->description,
        'video_link' => $request->youtubelink,
        'thumbnail' => $url
    ]);

    return back()->with('success', 'Documentation Added Successfully');
}
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $contact = coba::create($validated);

    return response()->json($contact, 201);
}
    /**
     * Website slider delete
     *
     * @return \Illuminate\Http\Response
     */
    public function sliderDelete(GallerySlider $slider)
    {
        $slider->delete();

        $this->flashSuccess('Slider Deleted Successfully');

        return back();
    }

    public function landingDelete(LandingVideo $landing)
    {
        $landing->delete();

        $this->flashSuccess('Landing Deleted Successfully');

        return back();
    }
    public function DocumentationDelete(Documentation $documentation)
    {
        $documentation->delete();

        $this->flashSuccess('Document Deleted Successfully');

        return back();
    }

    /**
     * Social media Store
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function socialMediaStore(SocialLinkCreateRequest $request)
    {
        abort_if(! userCan('settings'), 403);

        try {
            (new CreateSocialLink)->execute($request);

            $this->flashSuccess('Social Media Created Successfully');

            return back();
        } catch (\Throwable $th) {
            $this->flashError($th->getMessage());

            return back();
        }
    }

    /**
     * Social media update
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function socialMediaUpdate(SocialLinkUpdateRequest $request, SocialLink $socialLink)
    {
        abort_if(! userCan('settings'), 403);

        try {
            (new UpdateSocialLink)->execute($request, $socialLink);

            $this->flashSuccess('Social Media Updated Successfully');

            return back();
        } catch (\Throwable $th) {
            $this->flashError($th->getMessage());

            return back();
        }
    }

    /**
     * Delete the Social Media in the database
     *
     * @return \Illuminate\Http\Response
     */
    public function socialMediaDelete(SocialLink $socialLink)
    {
        abort_if(! userCan('settings'), 403);

        try {
            $socialLink->delete();
            $this->flashSuccess('Social Media Deleted Successfully');

            return back();
        } catch (\Throwable $th) {
            $this->flashError($th->getMessage());

            return back();
        }
    }

    /**
     * Update the social media status
     *
     * @return \Illuminate\Http\Response
     */
    public function socialMediaStatusUpdate(Request $request, SocialLink $socialLink)
    {
        if ($socialLink->update(['status' => $request->status ? true : false])) {
            $this->flashSuccess('Social Media Status Updated');
        } else {
            $this->flashError('Something is wrong.');
        }

        return back();
    }

    /**
     * Schedule Settings Update
     *
     * @return \Illuminate\Http\Response
     */
    public function scheduleUpdate(Request $request)
    {
        abort_if(! userCan('settings'), 403);

        try {
            (new ScheduleUpdateService)->update($request);

            $this->flashSuccess('Schedule Setting Successfully');

            return back();
        } catch (\Throwable $th) {
            $this->flashError($th->getMessage());

            return back();
        }
    }

    /**
     * Display a listing of the currency.
     *
     * @return \Illuminate\Http\Response
     */
    public function currency()
    {
        abort_if(! userCan('settings'), 403);

        $currencies = Currency::paginate(15)->onEachSide(-1);

        return inertia('Admin/Settings/Currency', compact('currencies'));
    }

    /**
     * Store the currency item in the database
     *
     * @return \Illuminate\Http\Response
     */
    public function currencyStore(CurrencyCreateRequest $request)
    {
        abort_if(! userCan('settings'), 403);

        try {
            (new CreateCurrency)->execute($request);

            $this->flashSuccess('Currency Created Successfully');

            return back();
        } catch (\Throwable $th) {
            $this->flashError($th->getMessage());

            return back();
        }
    }

    /**
     * Update the currency item in the database
     *
     * @return \Illuminate\Http\Response
     */
    public function currencyUpdate(CurrencyUpdateRequest $request, Currency $currency)
    {
        abort_if(! userCan('settings'), 403);

        try {
            (new UpdateCurrency)->execute($request, $currency);

            $this->flashSuccess('Currency Updated Successfully');

            return back();
        } catch (\Throwable $th) {
            $this->flashError($th->getMessage());

            return back();
        }
    }

    /**
     * Delete the currency item in the database
     *
     * @return \Illuminate\Http\Response
     */
    public function currencyDelete(Currency $currency)
    {
        abort_if(! userCan('settings'), 403);

        if($currency->code == "USD"){
            $this->flashWarning('Currency USD can\'t be dalated');
            return back();
        }

        try {
            $currency->delete();

            $this->flashSuccess('Currency Deleted Successfully');

            return back();
        } catch (\Throwable $th) {
            $this->flashError($th->getMessage());

            return back();
        }
    }

    /**
     * Update the currency status
     *
     * @return \Illuminate\Http\Response
     */
    public function currencyStatusUpdate(Request $request, Currency $currency)
    {
        $currency->update([
            'status' => $request->status ? true : false,
        ]);

        $this->flashSuccess('Currency Status Updated');

        return back();
    }

    /**
     * Upgrade guide page rendering
     *
     * @return \Illuminate\Http\Response
     */
    public function upgrade()
    {
        abort_if(! userCan('settings'), 403);

        return Inertia::render('Admin/Settings/Upgrade');
    }

    /**
     * Upgrade applying
     *
     * @return \Illuminate\Http\Response
     */
    public function upgradeApply()
    {
        exec('php artisan migrate');

        $this->flashSuccess('Application Upgrade Successfully');

        return back();
    }

    /**
     * Recaptcha page
     *
     * @return \Illuminate\Http\Response
     */
    public function recaptcha()
    {
        abort_if(! userCan('settings'), 403);

        $data['site_key'] = config('captcha.sitekey');
        $data['secret'] = config('captcha.secret');
        $data['status'] = config('captcha.active');

        return Inertia::render('Admin/Settings/Recaptcha', $data);
    }

    /**
     * Recaptcha update
     *
     * @return \Illuminate\Http\Response
     */
    public function recaptchaUpdate(Request $request)
    {
        abort_if(! userCan('settings'), 403);

        $request->validate([
            'recaptcha_key' => 'required',
            'recaptcha_secret' => 'required',
            // 'recaptcha' => new RecaptchaValidationRule($request->recaptcha),
        ]);

        $status = $request->status == 'on' ? 'true' : 'false';
        setEnv('RECAPTCHA_ACTIVE', $status);

        $site_key = $request->recaptcha_key;
        $secret = $request->recaptcha_secret;

        setEnv('RECAPTCHA_SITEKEY', $site_key);
        setEnv('RECAPTCHA_SECRET', $secret);

        $this->flashSuccess('Recaptcha Setting Update Successfully.');

        return back();
    }

    /** SMTP Settings
     *
     * @return \Illuminate\Http\Response
     */
    public function smtp()
    {
        abort_if(! userCan('settings'), 403);

        $data['host'] = config('mail.mailers.smtp.host');
        $data['port'] = config('mail.mailers.smtp.port');
        $data['encryption'] = config('mail.mailers.smtp.encryption');
        $data['username'] = config('mail.mailers.smtp.username');
        $data['password'] = config('mail.mailers.smtp.password');
        $data['address'] = config('mail.from.address');
        $data['name'] = config('mail.from.name');

        return inertia('Admin/Settings/SMTP', $data);
    }

    /** SMTP Settings Update
     *
     * @return \Illuminate\Http\Response
     */
    public function smtpUpdate(SmtpRequest $request)
    {
        abort_if(! userCan('settings'), 403);

        $data = $request->only(['mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_encryption', 'mail_from_name', 'mail_from_address']);

        foreach ($data as $key => $value) {
            $env = new Env;
            $env->setValue(strtoupper($key), $value);
        }

        $this->flashSuccess('Mail configuration update successfully');

        return back();
    }

    /**
     * Sent test email settings
     *
     * @return \Illuminate\Http\Response
     */
    public function testEmailSent(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        try {
            Mail::to(request()->email)->send(new SmtpTestEmail);

            $this->flashSuccess('Test email sent successfully.');

            return back();
        } catch (\Throwable $th) {
            $this->flashError('Invalid email configuration. Mail send failed.');

            return back();
        }
    }

    /**
     * Payment Settings
     *
     * @return \Illuminate\Http\Response
     */
    public function payment()
    {
        abort_if(! userCan('settings'), 403);

        $data['paypal'] = [
            'paypal_mode' => config('paypal.mode'),
            'paypal_sandbox_client_id' => config('paypal.sandbox.client_id'),
            'paypal_sandbox_client_secret' => config('paypal.sandbox.client_secret'),
            'paypal_live_client_id' => config('paypal.live.client_id'),
            'paypal_live_client_secret' => config('paypal.live.client_secret'),
            'paypal_active' => config('paypal.active'),
        ];

        $data['stripe'] = [
            'stripe_key' => config('templatecookie.stripe_key'),
            'stripe_secret' => config('templatecookie.stripe_secret'),
            'stripe_active' => config('templatecookie.stripe_active'),
        ];

        $data['razorpay'] = [
            'razorpay_key' => config('templatecookie.razorpay_key'),
            'razorpay_secret' => config('templatecookie.razorpay_secret'),
            'razorpay_active' => config('templatecookie.razorpay_active'),
        ];

        $data['flutterwave'] = [
            'flw_public_key' => config('templatecookie.flw_public_key'),
            'flw_secret' => config('templatecookie.flw_secret'),
            'flw_secret_hash' => config('templatecookie.flw_secret_hash'),
            'flw_active' => config('templatecookie.flw_active'),
        ];

        $data['midtrans'] = [
            'midtrans_merchant_id' => config('templatecookie.midtrans_merchant_id'),
            'midtrans_client_key' => config('templatecookie.midtrans_client_key'),
            'midtrans_server_key' => config('templatecookie.midtrans_server_key'),
            'midtrans_active' => config('templatecookie.midtrans_active'),
            'midtrans_live_mode' => config('templatecookie.midtrans_live_mode') ? 'live' : 'sandbox',
        ];

        return inertia('Admin/Settings/Payment', $data);
    }

    /**
     * Payment Settings Update
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentUpdate(Request $request)
    {
        // return $request;
        abort_if(! userCan('settings'), 403);

        $message = (new PaymentUpdateService)->update($request);

        $this->flashSuccess($message);

        return back();
    }

    /**
     * Other Settings
     *
     * @return \Illuminate\Http\Response
     */
    public function other()
    {
        abort_if(! userCan('settings'), 403);

        return inertia('Admin/Settings/Other');
    }

    /**
     * Run Command Settings
     *
     * @return \Illuminate\Http\Response
     */
    public function runCommand(string $type)
    {
        abort_if(! userCan('settings'), 403);

        $message = (new RunCommandService)->command($type);

        $this->flashSuccess($message);

        return back();
    }

    public function examGradesUpdate(Request $request)
    {
        $request->validate([
            'grades' => 'required',
            'grades_summary' => 'required',
        ]);

        Setting::first()->update([
            'key_to_grades' => $request->grades,
            'grade_summary' => $request->grades_summary,
        ]);

        $this->flashSuccess('Exam Grades Rules Update Successfully');

        return back();
    }

    /**
     * Payment SMS
     *
     * @return \Illuminate\Http\Response
     */
    public function sms()
    {
        abort_if(! userCan('settings'), 403);

        $data['twilio'] = [
            'twilio_sid' => config('templatecookie.twilio_sid'),
            'twilio_token' => config('templatecookie.twilio_token'),
            'twilio_from' => '+'.substr(config('templatecookie.twilio_from'), 3),
            'twilio_active' => config('templatecookie.twilio_active'),
        ];

        return inertia('Admin/Settings/Sms', $data);
    }

    public function smsUpdate(Request $request)
    {
        // return $request;
        abort_if(! userCan('settings'), 403);

        $message = (new SmsUpdateService)->update($request);

        $this->flashSuccess($message);

        return back();
    }

    public function singleTranslate(Request $request)
    {
        abort_if(! userCan('language'), 403);
        // return $request;
        $langFile = base_path('lang/'.$request->code.'.json'); // Assuming 'ar.json' is in the 'lang' folder in the root directory
        $translations = json_decode(file_get_contents($langFile), true);
        $translate = new GoogleTranslate;

        // Get the translation requested by the user
        $requestedTranslation = $request->translation;

        // Check if the requested translation exists as a property in the translations array
        if (isset($translations[$requestedTranslation])) {
            // Translate the value to Arabic
            $translatedValue = $translate->setSource('en')->setTarget($request->code)->translate($requestedTranslation);

            // Update the translationData array with the translated value
            $translations[$requestedTranslation] = $translatedValue;
        }

        // Save the translated data back to the JSON file with JSON_UNESCAPED_UNICODE option
        file_put_contents($langFile, json_encode($translations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        $this->flashSuccess('Language translation updated successfully.');
        $translations = json_decode(file_get_contents($langFile), true);

        return $translations;
    }

    public function languageTranslate(Request $request)
    {
        $langFile = base_path('lang/'.$request->code.'.json'); // Assuming 'ar.json' is in the 'lang' folder in the root directory
        $translationData = json_decode(file_get_contents($langFile), true);

        // Create a new GoogleTranslate instance
        $translate = new GoogleTranslate;

        // Set the target language to Arabic (ar)
        $targetLanguage = $request->code;

        // Loop through each translation key-value pair and translate the text
        foreach ($translationData as $key => $value) {
            // Translate the value to Arabic
            $translatedValue = $translate->setSource('en')->setTarget($targetLanguage)->translate($value);

            // Update the translationData array with the translated value
            $translationData[$key] = $translatedValue;
        }

        // Save the translated data back to the JSON file with JSON_UNESCAPED_UNICODE option
        file_put_contents($langFile, json_encode($translationData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        $this->flashSuccess('Language translation updated successfully.');

        return redirect()->route('languages.index');

    }

    // SettingController.php
    public function updateMobile(Request $request)
    {
        $request->validate([
            'production_status' => 'required',
            'mobile_version' => 'required',
        ]);

        Setting::first()->update([
            'production_status' => $request->production_status,
            'mobile_version' => $request->mobile_version,
        ]);

        return back()->with('success', 'Mobile settings updated successfully.');
    }

}
