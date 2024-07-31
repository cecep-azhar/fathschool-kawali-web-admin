<?php

namespace App\Actions\Auth;

use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ResetPasswordWeb
{
    /**
     * Request for password reset
     */
    public function request(Request $request): void
    {
        $user = $this->getUser($request);

        $code = rand(100000, 999999);

        \DB::table('password_resets')->insert([
            'phone' => $request->phone,
            'code' => $code,
            'created_at' => now(),
        ]);
        \DB::table('users')->where('id', $user->id)->update([
            'password' => bcrypt($code),
        ]);

        $currentDate = date('d-m-Y');
        $currentTime = date('H:i:s');
        $hour = date('H');

        if ($hour >= 0 && $hour < 12) {
            $greeting = 'Selamat Pagi';
        } elseif ($hour >= 12 && $hour < 18) {
            $greeting = 'Selamat Sore';
        } else {
            $greeting = 'Selamat Malam';
        }

        $message = "$currentDate\n\n";
        $message .= "Pukul $currentTime\n\n";
        $message .= "$greeting {$user->name},\n";
        $message .= "Password anda telah diganti menjadi\n\n";
        $message .= "$code\n\n";
        $message .= "Harap simpan perubahan password anda dengan hati-hati. Terima kasih.\n\n";
        $message .= "Send by Fathschool";

        $curl = curl_init();
        $link = 'https://wa.fath.my.id/send-message?api_key=VNDDEZ5KBWDQGl5XBTXv9pW2Y6GpNn&sender=6289635850446&number=' . $user->phone . '&message=' . urlencode($message);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $link,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
    }

    private function getUser(Request $request): User
    {
        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            throw ValidationException::withMessages(['phone' => __('auth.password.user')]);
        }

        if ($user->status != UserStatus::ACTIVATED->value) {
            throw ValidationException::withMessages(['phone' => __('auth.password.errors.account_not_activated')]);
        }

        return $user;
    }
}
