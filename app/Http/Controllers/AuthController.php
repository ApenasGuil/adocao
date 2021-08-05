<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Image;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function profile()
    {
        $user = User::where('id', '1')->first();
        return view('profile', [
            'user' => $user
        ]);
    }

    public function crop_avatar(Request $request)
    {
        // usar validor em images
        $validator = Validator::make($request->all(), [
            'image' => 'mimes:jpeg,bmp,png,gif,svg,pdf',
        ]);

        // $user = User::where('id', '=', '4')->first();
        $input = $request->all();

        if ($input['base64image'] || $input['base64image'] != '0') {
            $folderPath = public_path('/uploads/avatars/user-' . Auth::user()->id . '/');
            // $folderPath = public_path('\uploads\avatars\1');
            // dd(public_path('/uploads/avatars/'. Auth::user()->id . '/'));
            if (!File::isDirectory($folderPath)) {
                File::makeDirectory($folderPath, 0777, true, true);
            }
            $image_parts = explode(";base64,", $input['base64image']);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            // $file = $folderPath . uniqid() . '.png';
            $filename = time() . '.' . $image_type;
            $file = $folderPath . $filename;
            file_put_contents($file, $image_base64);

            $user = Auth::user();
            $user->avatar = 'user-' . Auth::user()->id . '/' . $filename;
            $user->save();

            return redirect('/crop');
        }
    }


    public function update_avatar(Request $request)
    {
        $user = Auth::user();
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->save(public_path('/uploads/avatars/' . $filename));

            // Image::make($avatar)->save( public_path('/uploads/avatars/id'.$user->id.'/'.$filename));

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();

            //     $user->profile_picture = $filename;
            //     $user->save();

            //     return redirect()->route('me')->with([
            //         'user' => $user,
            //         'error' => 'success',
            //         'msg' => 'Imagem alterada com sucesso!',
            //     ]);
            // } else {
            //     return redirect()->route('me')->with([
            //         'user' => $user,
            //         'error' => 'danger',
            //         'msg' => 'Erro ao alterar imagem',
            //     ]);
        }





        // if($request->hasFile('avatar')){
        //     $avatar = $request->file('avatar');
        //     $filename = time().'.'.$avatar->getClientOriginalExtension();
        //     Image::make($avatar)->save( public_path('/uploads/avatars/'.$filename));

        //     $user = Auth::user();
        //     $user->profile_picture = $filename;
        //     $user->save();

        //     return redirect()->route('me', [
        //         'user' => $user
        //     ]);
        // }
    }


    public function deletePic(User $user)
    {
        $user->profile_picture = 'default.jpg';
        $user->save();

        return redirect()->route('me')->with([
            'user' => $user,
            'error' => 'warning',
            'msg' => 'Imagem deletada com sucesso!',
        ]);
    }

    public function showLoginForm()
    {
        return view('loginForm');
    }

    public function login(Request $request)
    {
        //var_dump($request->only('email', 'password'));

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('pets.index');
        }

        return redirect()->route('login')->with([
            'error' => 'danger',
            'msg' => 'E-mail e/ou senha incorretos',
        ]);
    }

    public function showRegisterForm()
    {
        return view('registerForm');
    }

    public function register(Request $request)
    {
        $input['name'] = $request->name;
        $input['email'] = $request->email;
        $input['cpf'] = $request->cpf;
        $input['password'] = $request->password;

        $rules = [
            'name' => 'required|max:5',
            'email' => 'required|unique:users|email',
            'cpf' => 'required|unique:users',
            'password' => 'required'
        ];
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            dd('validator pegou');
            return redirect()->route('register')->with([
                'error' => 'danger',
                'msg' => 'Campos inválidos. Tente novamente.',
            ])->withInput($request->except('password'));
        } else {
            $newUser = new User;
            $newUser->name = $input['name'];
            $newUser->email = $input['email'];
            $newUser->cpf = $input['cpf'];
            $newUser->password = Hash::make($input['password']);
            // $newUser->save();

            if ($newUser->save()) {
                Auth::login($newUser);
                return redirect()->route('home');
            } else {
                return redirect()->route('register')->with([
                    'error' => 'danger',
                    'msg' => 'Algo deu errado, por favor entre em contato com o administrador do site.',
                ])->withInput($request->except('password'));
            }
        }
    }


    public function dashboard()
    {
        $users = User::all();
        //dd($users);
        if (Auth::check() === true) {
            return view('admin.users', [
                'users' => $users
            ]);
        }
        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
