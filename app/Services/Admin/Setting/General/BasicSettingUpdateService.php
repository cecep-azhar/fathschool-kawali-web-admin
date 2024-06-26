<?php

namespace App\Services\Admin\Setting\General;

use App\Actions\File\FileDelete;
use App\Actions\File\FileUpload;
use App\Models\Setting;

class BasicSettingUpdateService
{
    public function update(object $request)
    {
        $setting = Setting::first();

        $setting->update([
            'app_name' => $request->app_name,
            'school_code' => $request->school_code,
            'app_logo_type' => $request->logo_type,
            'text_logo_name' => $request->text_logo_name,
            'principal_name' => $request->principal_name,
            'app_email' => $request->app_email,
            'app_phone' => $request->app_phone,
            'app_address' => $request->app_address,
            'app_description' => $request->app_description,
        ]);

        // if form has dark logo
        if ($request->hasFile('dark_logo')) {

            if ($setting->dark_logo != 'images/dark_logo.png') {
                FileDelete::deleteImage($setting->dark_logo);
            }
            $url = FileUpload::uploadImage($request->dark_logo, 'images');
            $setting->update([
                'dark_logo' => $url,
            ]);
        }

        // if form has light logo
        if ($request->hasFile('light_logo')) {

            if ($setting->light_logo != 'images/light_logo.png') {
                FileDelete::deleteImage($setting->light_logo);
            }
            $url = FileUpload::uploadImage($request->light_logo, 'images');
            $setting->update([
                'light_logo' => $url,
            ]);
        }

        // if form has favicon logo
        if ($request->hasFile('favicon')) {

            if ($setting->favicon_icon != 'images/favicon.png') {
                FileDelete::deleteImage($setting->favicon_icon);
            }
            $url = FileUpload::uploadImage($request->favicon, 'images');
            $setting->update([
                'favicon_icon' => $url,
            ]);
        }
    }
}
