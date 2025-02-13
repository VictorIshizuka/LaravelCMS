<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use \App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index()
    {

        $settings = [];

        $dbSettings = Setting::get();

        foreach ($dbSettings as $dbSetting) {
            $settings[$dbSetting['name']] = $dbSetting['content'];
        }

        return view('admin.settings.index', ['settings' => $settings]);
    }

    public function save(Request $request)
    {
        $data = $request->only(['title', 'subtitle', 'email', 'bgcolor', 'textcolor']);
        $validator = $this->validator($data);

        if ($validator->fails()) {
            return redirect()->route('painel.settings.index')
                ->withErrors($validator);
        }

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['name' => $key], ['content' => $value]);
        }

        return redirect()->route('painel.settings.index')->with('success', 'Configurações atualizadas com sucesso!');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => ['string', 'max:100'],
            'subtitle' => ['string', 'max:100'],
            'email' => ['string', 'email'],
            'bgcolor' => ['string', 'regex:/#[A-Z0-9]{6}/i'],
            'textcolor' => ['string', 'regex:/#[A-Z0-9]{6}/i'],
        ]);
    }
}
