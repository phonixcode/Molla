<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SettingsController extends Controller
{
    public function settings()
    {
        return view('admin.settings.settings', [
            'setting' => Settings::first()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSettings(Request $request)
    {
        $settings = $this->update($request);

        return $settings
            ? back()->with('success', 'Setting successfully updated')
            : back()->with('error', 'Something went wrong!');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    private function update(Request $request)
    {
        $settings = Settings::first()->update([
            'title' => $request->title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'logo' => $request->logo,
            'favicon' => $request->favicon,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'fax' => $request->fax,
            'facebook_url' => $request->facebook_url,
            'twitter_url' => $request->twitter_url,
            'instagram_url' => $request->instagram_url,
            'linkedin_url' => $request->linkedin_url,
            'pinterest_url' => $request->pinterest_url
        ]);
        return $settings;
    }

    public function optimize()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
        Artisan::call('route:cache');
        Artisan::call('view:clear');
        Artisan::call('optimize:clear');
        return back()->with('success', 'Cache cleared successfully');
    }
}
