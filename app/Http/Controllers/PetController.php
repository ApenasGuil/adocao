<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pets = Pet::orderBy('id', 'desc')->get();
        return view('pets', [
            'pets' => $pets
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('register-pet');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Request $request)
    {
        $input['name'] = $request->name;
        $input['age'] = $request->age;
        $input['sex'] = $request->sex;
        $input['type'] = $request->type;
        $input['breed'] = $request->breed;
        $input['bio'] = $request->bio;
        $input['foto'] = $request->fotinha;

        $rules = [
            'name' => 'required',
            'age' => 'required',
            'sex' => 'required',
            'type' => 'required',
            'breed' => 'required',
            'bio' => 'required',
            'fotinha' => 'mimes:jpeg,bmp,png,svg',
        ];

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return redirect()->route('register')->with([
                'error' => 'danger',
                'msg' => 'Campos inválidos. Tente novamente.',
            ]);
        } else {
            $pet = new Pet;
            $pet->user_id = Auth::user()->id;
            $pet->name = $request->name;
            $pet->age = $request->age;
            if ($request->sex == 'male') {
                $pet->sex = '1';
            } else {
                $pet->sex = '0';
            }
            $pet->type = $request->type;
            $pet->breed = $request->breed;
            $pet->bio = $request->bio;
            $pet->picture = 'null';
            $pet->save();

            $folderPath = public_path('/uploads/pictures/user-' . Auth::user()->id . '/pet-' . $pet->id . '/');
            // $folderPath = public_path('\uploads\avatars\1');
            // dd(public_path('/uploads/avatars/'. Auth::user()->id . '/'));

            if (!File::isDirectory($folderPath)) {
                File::makeDirectory($folderPath, 0777, true, true);
            }
            // dd($folderPath);

            $request->validate([
                'fotinha' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time() . '.' . $request->fotinha->extension();

            $request->fotinha->move($folderPath, $imageName);


            $pet->picture = $imageName;

            if ($pet->update()) {
                return redirect(RouteServiceProvider::HOME)->with([
                    'error' => 'success',
                    'msg' => 'Seu pet foi adicionado para adoção e já está visível!',
                ]);
            } else {
                return redirect()->route('pet.create')->with([
                    'error' => 'danger',
                    'msg' => 'Algo deu errado, por favor entre em contato com o administrador do site.',
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function show(Pet $pet)
    {
        return view('pet-info', [
            'pet' => $pet
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function edit(Pet $pet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pet $pet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pet $pet)
    {
        //
    }
}
