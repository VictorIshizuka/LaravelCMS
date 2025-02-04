<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $loggedId = intval(Auth::id());
        $user = User::find($loggedId);

        if (!$user) {
            return redirect()->route('painel.login');
        }
        return view('admin.profile.index', ['user' => $user]);
    }

    public function update(Request $request)
    {

        $data = $request->only(['name', 'email', 'password', 'password_confirmation']);

        $validator =  Validator::make(['name' => $data['name'], 'email' => $data['email']], [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100']
        ]);

        $loggedId = intval(Auth::id());
        $user = User::find($loggedId);

        if ($user) {
            $user->name = $request->name;
            if ($user->email !== $data['email']) {
                $hasEmail = User::where('email',  $data['email'])->first();
                if ($hasEmail) {
                    $validator->errors()->add('email', __('validation.unique', ['email' => $data['email']]));
                } else {
                    $user->email = $data['email'];
                }
            }
            if (!empty($data['password'])) {
                if (strlen($data['password']) < 4) {
                    $validator->errors()->add('password', __('validation.min.string', ['attribute' => 'password', 'min' => 4]));
                }

                if ($data['password'] !== $data['password_confirmation']) {
                    $validator->errors()->add('password', __('validation.confirmed', ['attribute' => 'password']));
                }

                if (count($validator->errors()) > 0) {
                    return redirect()->route('painel.profile', ['id' => $loggedId])
                        ->withErrors($validator)->withInput();
                }

                $user->password = Hash::make($data['password']);
            }
            $user->save();
            return redirect()->route('painel.profile')->with('success', 'Perfil atualizado com sucesso!');

        }
        return redirect()->route('painel.profile');
    }
}
