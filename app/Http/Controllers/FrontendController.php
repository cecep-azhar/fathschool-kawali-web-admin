<?php

namespace App\Http\Controllers;

use App\Http\Requests\Website\StudentAdmissionRequest;
use App\Models\AdmissionFormField;
use App\Models\Course;
use App\Models\GallerySlider;
use App\Models\LandingVideo;
use App\Models\Notice;
use App\Services\Frontend\Admission\AdmissionRequestService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class FrontendController extends Controller
{
    /**
     * Display the frontend home page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = GallerySlider::all();
        $landings = LandingVideo::first();

        // dd($youtube);

        return inertia('Frontend/Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'sliders' => $sliders,
            'landing' => $landings,
        ]);
    }

    /**
     * Display the frontend admission page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function admission()
    {
        $fields = AdmissionFormField::active()->orderBy('order', 'ASC')->get();

        return inertia('Frontend/Admission', [
            'fields' => $fields,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'courses' => Course::select('id', 'name')->get(),
            'session' => Carbon::now()->format('Y').' - '.Carbon::now()->format('Y'),
        ]);
    }

    /**
     * Store the student admission data
     *
     * @return \Illuminate\Http\Response
     */
    public function admissionStore(StudentAdmissionRequest $request)
    {

        try {

            (new AdmissionRequestService)->admission($request);
            $this->flashSuccess('Admission request sent.');

            return back();
        } catch (\Throwable $th) {
            $this->flashWarning('Admission Failed:'.$th->getMessage());

            return back();
        }
    }

    /**
     * Display the frontend announcement page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function announcement()
    {
        $notices = Notice::with('user:id,name,username')->public()->latest()->limit(18)->get();

        return inertia('Frontend/Announcement', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'notices' => $notices,
        ]);
    }
    public function aboutschool()
    {
        $notices = Notice::with('user:id,name,username')->public()->latest()->limit(18)->get();

        return inertia('Frontend/AboutSchool', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'notices' => $notices,
        ]);
    }
    public function feature()
    {
        $notices = Notice::with('user:id,name,username')->public()->latest()->limit(18)->get();

        return inertia('Frontend/Feature', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'notices' => $notices,
        ]);
    }
    public function contact()
    {
        $notices = Notice::with('user:id,name,username')->public()->latest()->limit(18)->get();

        return inertia('Frontend/Kontak', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'notices' => $notices,
        ]);
    }
    public function documentation()
    {
        $notices = Notice::with('user:id,name,username')->public()->latest()->limit(18)->get();

        return inertia('Frontend/Dokumentasi', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'notices' => $notices,
        ]);
    }

    /**
     * Display the frontend announcement page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function announcementDetails(Notice $notice)
    {
        abort_if($notice->status == 'private', 404);

        $notice->load('user:id,name,username');

        return inertia('Frontend/AnnouncementDetails', [
            'notice' => $notice,
        ]);
    }

    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            $this->createIncomeTransaction(payment_type: 'Paypal');

            return redirect()->route('payment.successful');
        } else {
            $this->flashError('Transaction is Invalid');

            return back();
        }
    }
}
