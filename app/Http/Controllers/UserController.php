<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('userProfile', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function upload_profile_picture(Request $request, User $user)
    {
        // dd(Auth::user()->check_picture());
        // dd(Auth::user()->avatar);
        // usar validor em images
        $validator = Validator::make($request->all(), [
            'image' => 'mimes:jpeg,bmp,png,gif,svg,pdf',
        ]);

        // $user = User::where('id', '=', '4')->first();
        $input = $request->all();

        if ($input['base64image'] || $input['base64image'] != '0') {
            $folderPath = public_path('/uploads/pictures/user-' . Auth::user()->id . '/avatar' . '/');
            // $folderPath = public_path('\uploads\avatars\1');
            // dd(public_path('/uploads/avatars/'. Auth::user()->id . '/'));
            if (!File::isDirectory($folderPath)) {
                File::makeDirectory($folderPath, 0777, true, true);
            }
            $image_parts = explode(";base64,", $input['base64image']);
            $image_type_aux = explode("image/", $image_parts[0]);
            if($image_type_aux[0] == ""){
                return redirect()->back()->with([
                    'error' => 'danger',
                    'msg' => 'Selecione uma nova foto de perfil antes de enviar.',
                ]);
            }
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            // $file = $folderPath . uniqid() . '.png';
            $filename = time() . '.' . $image_type;
            $file = $folderPath . $filename;
            file_put_contents($file, $image_base64);

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();

            return redirect()->back()->with([
                'error' => 'success',
                'msg' => 'Foto de perfil salva com sucesso.',
            ]);
        }
        
    }
}
