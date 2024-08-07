<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::where('id', 1)->first();

        return view('pages.dashboard.settings.index', compact('setting'));
    }

    public function update(UpdateSettingRequest $request)
    {
        try {
            $setting = Setting::where('id', 1)->first();

            if ($request->hasFile('auth_bg')) {
                Storage::delete('public/uploads/settings/' . $setting->auth_bg);
                $setting->auth_bg = basename($request->file('auth_bg')->store('public/uploads/settings'));
            }

            if ($request->hasFile('report_logo')) {
                Storage::delete('public/uploads/settings/' . $setting->report_logo);
                $setting->report_logo = basename($request->file('report_logo')->store('public/uploads/settings'));
            }

            if ($request->hasFile('app_logo')) {
                Storage::delete('public/uploads/settings/' . $setting->app_logo);
                $setting->app_logo = basename($request->file('app_logo')->store('public/uploads/settings'));
            }

            $setting->app_name = $request->app_name;
            $setting->app_desc = $request->app_desc;
            $setting->report_header = $request->report_header;
            $setting->auto_forward = $request->auto_forward;
            $setting->report_reminder = $request->report_reminder;
            $setting->update();
            
            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function komisi_update(Request $request)
    {
        try {
            $setting = Setting::where('id', 1)->first();

            $setting->nama_ketua_komisi = $request->nama_ketua_komisi;
            $setting->nip_ketua_komisi = $request->nip_ketua_komisi;
            $setting->update();
            
            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }
}
