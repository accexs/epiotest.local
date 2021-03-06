<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Recipe;
use App\User;
use Validator;
use Auth;
use Illuminate\Support\Facades\Mail;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(Auth::user()->recipes);
    }

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
        $rules = [
            'name' => 'required|alpha|max:50',
            'lastname' => 'required|alpha|max:50',
            'ci' => 'required|max:10',
            'bdate' => 'date',
            'email' => 'email|max:50',
            'meds' => 'required|max:1000',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all()
                ]);
        }else{
            $recipe = new Recipe;
            $recipe -> name = $request->input('name');
            $recipe -> lastname = $request->input('lastname');
            $recipe -> ci = $request->input('ci');
            $recipe -> bdate = $request->input('bdate');
            $recipe -> email = $request->input('email');
            $recipe -> meds = $request->input('meds');
            Auth::user()->recipes()->save($recipe);
            return response()->json([
                'success' => true
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return response()->json(Recipe::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rules = [
            'name' => 'required|alpha|max:50',
            'lastname' => 'required|alpha|max:50',
            'ci' => 'required|max:10',
            'bdate' => 'date',
            'email' => 'email|max:50',
            'meds' => 'required|max:1000',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all()
                ]);
        }else{
            $recipe = Recipe::find($id);
            $recipe -> name = $request->input('name');
            $recipe -> lastName = $request->input('lastname');
            $recipe -> ci = $request->input('ci');
            $recipe -> bdate = $request->input('bdate');
            $recipe -> email = $request->input('email');
            $recipe -> meds = $request->input('meds');
            //$recipe -> desc = $request('desc');
            $recipe -> save();
            return response()->json([
                'success' => true
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function send($id) {
        //
        $rules = [
            'name' => 'required|alpha|max:50',
            'lastname' => 'required|alpha|max:50',
            'ci' => 'required|max:10',
            'bdate' => 'date',
            'email' => 'required|email|max:50',
            'meds' => 'required|max:1000',
        ];
        $recipe = Recipe::find($id);
        Mail::send('emails.recipe',[
            'name' => $recipe->name,
            'lastname' => $recipe->lastname,
            'ci' => $recipe->ci,
            'bdate' => $recipe->bdate,
            'meds' => $recipe->meds
            ],  function($message) use ($recipe) {
                $message->from('noreply@epiotest.local');
                $message->to($recipe->email)->subject('Récipe médico');
                    
        });
        return response()->json([
            'success' => true
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Recipe::destroy($id);
        return response()->json([
            'success' => true
            ]);
    }
}
