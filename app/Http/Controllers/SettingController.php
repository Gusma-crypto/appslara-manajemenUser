<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }
    public function editEmail()
    {
        $settings = [
            'MAIL_MAILER' => Setting::getValue('MAIL_MAILER', 'smtp'),
            'MAIL_HOST' => Setting::getValue('MAIL_HOST'),
            'MAIL_PORT' => Setting::getValue('MAIL_PORT'),
            'MAIL_USERNAME' => Setting::getValue('MAIL_USERNAME'),
            'MAIL_PASSWORD' => Setting::getValue('MAIL_PASSWORD'),
            'MAIL_ENCRYPTION' => Setting::getValue('MAIL_ENCRYPTION'),
            'MAIL_FROM_ADDRESS' => Setting::getValue('MAIL_FROM_ADDRESS'),
            'MAIL_FROM_NAME' => Setting::getValue('MAIL_FROM_NAME'),
        ];

        return view('superadmin.settings.email', compact('settings'));
    }

    public function updateEmail(Request $request)
    {
        foreach ($request->only([
            'MAIL_MAILER',
            'MAIL_HOST',
            'MAIL_PORT',
            'MAIL_USERNAME',
            'MAIL_PASSWORD',
            'MAIL_ENCRYPTION',
            'MAIL_FROM_ADDRESS',
            'MAIL_FROM_NAME',
        ]) as $key => $value) {
            Setting::setValue($key, $value);
        }

        return back()->with('success', 'Pengaturan email berhasil diperbarui.');
    }
}
