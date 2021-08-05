<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pets = Pet::all();
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
        if (
            $request->name == null  ||
            $request->type === null ||
            $request->breed == null ||
            $request->sex == null   ||
            $request->age == null   ||
            $request->bio == null
        ) {
            return Redirect::back()->with([
                'error' => 'danger',
                'msg' => 'algo esta vazio!',
            ])->withInput($request->all());
        }
        return Redirect::back()->with([
            'error' => 'success',
            'msg' => 'sexooooooooooooooooo',
        ])->withInput($request->all());

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'breed' => 'required',
            'sex' => 'required',
            'age' => 'required',
            'bio' => 'required',
        ]);

        dd($request->all());

        if ($request['sex'] == 'male') {
            dd('male');
        } elseif ($request['sex'] == 'female') {
            dd('female');
        }

        if ($validator->fails()) {
            return redirect()->route('register')->with([
                'error' => 'danger',
                'msg' => 'SEM SEXO!',
            ]);
        } else {
            dd('sexooooooooooooooooo');
            $newUser = new User;
            $newUser->name = $request->name;
            $newUser->email = $request->email;
            $newUser->password = Hash::make($request->password);
            $newUser->save();

            if (!Auth::login($newUser)) {
                return redirect()->route('login');
            }

            return redirect()->route('register')->with([
                'error' => 'success',
                'msg' => 'Usuário cadastrado com sucesso!',
            ]);
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
        //
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
