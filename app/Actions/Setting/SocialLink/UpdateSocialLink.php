<?php

namespace App\Actions\Setting\SocialLink;

use App\Actions\File\FileUpload;

class UpdateSocialLink
{
    public function execute(object $request, object $socialLink)
    {
        if ($request->hasFile('icon')) {
            $request->validate(['icon' => 'required|file|mimes:png,jpg,jpeg,svg|max:5120']);
        }

        $socialLink->update([
            'name' => $request['name'],
            'url' => $request['url'],
        ]);

        if ($request->hasFile('icon')) {
            $url = FileUpload::uploadImage($request->icon, 'social_links');
            $socialLink->update(['icon' => $url]);
        }

        return $socialLink;
    }
}
