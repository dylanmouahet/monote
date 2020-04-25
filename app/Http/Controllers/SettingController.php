<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordForm;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $setting = Setting::where('user_id', Auth::user()->id)->firstOrFail();

        return view('page.setting_index',
                [
                    'title' => 'Parametre',
                    'setting' => $setting,
                ]
        );
    }

    public function changePassword(ChangePasswordForm $request)
    {
        if(!Hash::check($request->old_password, Auth::user()->password))
        {
            msg_flash('Le mot de passe entré est incorrect', "danger");
            return redirect()->route('setting');
        }

        $user = User::where('id', Auth::user()->id)->firstOrFail();
        $user->update(['password' => Hash::make($request->password)]);

        msg_flash('Le mot de passe a été modifié avec succès', "success");
        return redirect()->route('setting');
    }

    public function deleteAccount(Request $request)
    {
        if(!Hash::check($request->password, Auth::user()->password))
        {
            msg_flash('Le mot de passe entré est incorrect', "danger");
            return redirect()->route('setting');
        }

        $user = User::where('id', Auth::user()->id)->firstOrFail();
        $user->delete();

        msg_flash('Votre compte a bien été supprimé', "danger");
        return redirect()->route('login');
    }

    public function updatePreference(Request $request)
    {
        $setting = Setting::where('user_id', Auth::user()->id)->firstOrFail();
        $setting->update(
            [
                'notification' => isset($request->notification) ? '1' : '0',
                'newsletter' => isset($request->newsletter) ? '1' : '0',
            ]
        );
        

        msg_flash('Vos préférences ont été modifié avec succès', "success");
        return redirect()->route('setting');
        
    }
}
