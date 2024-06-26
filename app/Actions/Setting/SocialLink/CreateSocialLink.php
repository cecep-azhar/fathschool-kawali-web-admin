<?php

namespace App\Actions\Setting\SocialLink;

use App\Actions\File\FileUpload;
use App\Models\SocialLink;

class CreateSocialLink
{
    public function execute(object $request)
    {
        $social_link = SocialLink::create([
            'name' => $request['name'],
            'url' => $request['url'],
        ]);

        if ($request->hasFile('icon')) {
            $url = FileUpload::uploadImage($request->icon, 'social_links');
            $social_link->update(['icon' => $url]);
        }

        return $social_link;
    }
}
