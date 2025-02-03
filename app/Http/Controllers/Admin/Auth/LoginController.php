<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(){
        return view('admin.login');
    }

public function authenticate(Request $request){
    $credentials = $request->only('email', 'password');

    $validator = $this->validator($credentials);

    $remember = $request->input('remember', false);

    if($validator->fails()){
        return redirect()->route('painel.login')
        ->withErrors($validator)
        ->withInput();
    }
    if(Auth::attempt($credentials, $remember)){
        return redirect()->route('painel.home');
    }
    $validator->errors()->add('password', 'Email e/ou senha inválidos');
    return redirect()->route('painel.login')
    ->withInput()
    ->withErrors($validator);
    // ->with('error', 'Email ou senha inválidos');
}

    public function logout(){
        Auth::logout();
        return redirect()->route('painel.login');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:100'],
            'password' => ['required', 'string', 'min:4'],
        ]);
    }
}
