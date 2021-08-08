<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $input['name'] = $request->name;
        $input['age'] = $request->age;
        $input['sex'] = $request->sex;
        $input['type'] = $request->type;
        $input['breed'] = $request->breed;
        $input['bio'] = $request->bio;
        $input['picture'] = $request->picture;

        $rules = [
            'name' => 'required',
            'age' => 'required',
            'sex' => 'required',
            'type' => 'required',
            'breed' => 'required',
            'bio' => 'required',
            'picture' => 'image',
        ];
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return redirect()->route('register')->with([
                'error' => 'danger',
                'msg' => 'Campos inválidos. Tente novamente.',
            ]);
        } else {
            
            $pet = new Pet;
            $pet->name = $request->name;
            $pet->age = $request->age;
            if($request->sex == 'male')
            {
                $pet->sex = '1';
            } else {
                $pet->sex = '0';
            }
            $pet->type = $request->type;
            $pet->breed = $request->breed;
            $pet->bio = $request->bio;
            $pet->picture = $request->picture;
            $pet->user_id = Auth::user()->id;

            if ($pet->save()) {
                return redirect(RouteServiceProvider::HOME)->with([
                    'error' => 'success',
                    'msg' => 'Seu pet foi adicionado para adoção e já está visível!',
                ]);
            } else {
                return redirect()->route('register')->with([
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
