<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Language\LanguageCreateRequest;
use App\Http\Requests\Admin\Language\LanguageUpdateRequest;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Inertia\Inertia;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(! userCan('language'), 403);

        return inertia('Admin/Settings/Language/Index', [
            'languages' => Language::paginate(15)->onEachSide(-1),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(! userCan('language'), 403);

        $path = base_path('public/json/languages.json');
        $translations = json_decode(file_get_contents($path), true);

        return Inertia::render('Admin/Settings/Language/Create', [
            'translations' => $translations,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(LanguageCreateRequest $request)
    {
        abort_if(! userCan('language'), 403);

        $language = Language::create([
            'name' => $request->name,
            'code' => $request->code,
            'direction' => $request->direction,
        ]);

        if ($language) {
            $baseFile = base_path('lang/en.json');
            $fileName = base_path('lang/'.Str::slug($request->code).'.json');
            copy($baseFile, $fileName);

            $this->flashSuccess('Language created successfully.');

            return redirect()->route('languages.index');
        } else {

            session()->flash('warning', 'Something is wrong.');

            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function settings(Language $language)
    {
        abort_if(! userCan('language'), 403);

        $path = base_path('lang/'.$language->code.'.json');
        $translations = json_decode(file_get_contents($path), true);
        $amount = count($translations);

        return inertia('Admin/Settings/Language/Show', [
            'translations' => $translations,
            'language' => $language,
            'amount' => $amount,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        abort_if(! userCan('language'), 403);

        if ($language->id != 1) {
            $path = base_path('public/json/languages.json');
            $translations = json_decode(file_get_contents($path), true);

            return Inertia::render('Admin/Settings/Language/Edit', [
                'translations' => $translations,
                'language' => $language,
            ]);
        } else {

            session()->flash('warning', 'Default language not editable.');

            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(LanguageUpdateRequest $request, Language $language)
    {
        abort_if(! userCan('language'), 403);
        if ($language->id != 1) {
            // rename file
            $oldFile = $language->code.'.json';
            $oldName = base_path('lang/'.$oldFile);
            $newFile = Str::slug($request->code).'.json';
            $newName = base_path('lang/'.$newFile);

            rename($oldName, $newName);

            // update
            $language->update([
                'name' => $request->name,
                'code' => $request->code,
                'direction' => $request->direction,
            ]);

            $this->flashSuccess('Language updated successfully.');

            return redirect()->route('languages.index');
        } else {

            session()->flash('warning', 'Default language not updateable.');

            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Language $language)
    {
        abort_if(! userCan('language'), 403);

        if ($language->id == 1) {
            return session()->flash('warning', 'You can not delete the default language');
        }

        $current_lang = Session()->get('locale');
        if ($current_lang == $language->code) {

            session()->flash('warning', 'Default language not deleteable.');

            return back();
        }

        // delete file
        if (File::exists(base_path('lang/'.$language->code.'.json'))) {
            File::delete(base_path('lang/'.$language->code.'.json'));
        }
        $language->delete();

        $this->flashSuccess('Language deleted successfully.');

        return back();
    }

    public function translationUpdate(Request $request, Language $language)
    {
        abort_if(! userCan('language'), 403);

        $filePath = base_path('lang/'.$language->code.'.json');
        $data = file_get_contents($filePath);
        $translations = json_decode($data, true);
        $requestTranslations = $request->translations;

        foreach ($translations as $key => $value) {
            if ($requestTranslations[$key]) {
                $translations[$key] = $requestTranslations[$key];
            } else {
                $translations[$key] = '';
            }
        }
        file_put_contents($filePath, json_encode($translations, JSON_UNESCAPED_UNICODE));

        $this->flashSuccess('Language translation updated successfully.');

        return redirect()->route('languages.index');
    }

    public function changeLang($dir)
    {
        Session::put('current_dir', $dir);

        return back();
    }
}
