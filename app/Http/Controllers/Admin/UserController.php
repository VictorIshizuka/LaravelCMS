<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {

        $users = User::paginate(2);
        $loggedId = Auth::id();

        return view('admin.users.index', ['users' => $users, 'loggedId' => $loggedId]);
    }

    public function create()
    {
        return view('admin.users.create');
    }


    public function store(Request $request)
    {

        $data = $request->only(['name', 'email', 'password', 'password_confirmation']);

        $validator =  Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('painel.users.create')
                ->withErrors($validator)
                ->withInput();
        }

        $user  =  new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        // Redirect to the users list
        return redirect()->route('painel.users.list');
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', ['user' => $user]);
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.show', ['user' => $user]);
    }


    public function update(Request $request, $id)
    {

        $data = $request->only(['name', 'email', 'password', 'password_confirmation']);

        $validator =  Validator::make(['name' => $data['name'], 'email' => $data['email']], [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100']
        ]);

        $user = User::find($id);

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
                    return redirect()->route('painel.users.edit', ['id' => $id])
                        ->withErrors($validator)->withInput();
                }

                $user->password = Hash::make($data['password']);
            }
            $user->save();
        }
        return redirect()->route('painel.users.list');
    }

    public function destroy($id)
    {
        $loggedId = intval(Auth::id());
        if ($loggedId !== $id) {
            $user = User::find($id);
            $user->delete();
        }
        return redirect()->route('painel.users.list');
    }
}
