<?php

namespace App\Actions\Auth;

use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ResetPasswordMobile
{
    /**
     * Request for password reset
     */
    public function request(Request $request): void
    {
        $user = $this->getUser($request);

        $code = rand(100000, 999999);

        \DB::table('password_resets')->insert([
            'email' => $request->email,
            'code' => $code,
            'created_at' => now(),
        ]);
        \DB::table('users')->where('id', $user->id)->update([
            'password' => bcrypt($code),
        ]);

        $curl = curl_init();
        $link = 'https://wa.fath.my.id/send-message?api_key=VNDDEZ5KBWDQGl5XBTXv9pW2Y6GpNn&sender=6289635850446&number=' . $user->phone . '&message=PasswordAnda:' . $code;
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

        // Hapus atau komentar bagian pengiriman email
        // (new SendMailTemplate)->execute(
        //     email: $user->email,
        //     code: 'reset-password-confirmation',
        //     variables: [
        //         'name' => $user->name,
        //         'code' => $code,
        //         'token_lifetime' => config('config.auth.reset_password_token_lifetime', 30),
        //     ]
        // );
    }

    private function getUser(Request $request): User
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages(['phone' => __('auth.password.user')]);
        }

        if ($user->status != UserStatus::ACTIVATED->value) {
            throw ValidationException::withMessages(['phone' => __('auth.password.errors.account_not_activated')]);
        }

        return $user;
    }
}
