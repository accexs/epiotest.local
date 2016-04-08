<?php

namespace App\Http\Controllers;

use App\User;
//use App\Mailers\AppMailer;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request/*, AppMailer $mailer*/)
    {
        //
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all()]);
        }else{
            $user = new User;
            $user -> name = $request->input('name');
            $user -> email = $request->input('email');
            $user -> password = bcrypt($request->input('password'));
            $user -> confirmation_code = str_random(30);
            $user -> save();
            //send confirmation
            Mail::send('emails.confirm',[
                    'name' => $user->name,
                    'token' =>  'http://epiotest.local/register/verify/'.$user->confirmation_code
                    ], function($message) use ($user) {
                        $message->from('noreply@epiotest.local');
                        $message->to($user->email)->subject('confirmación cuenta epiotest');
                        
                });

            return response()->json([
                'success' => true]);
        }
    }

    public function confirm ($token)
    {
        //
        $user = User::where('confirmation_code', $token)->firstOrFail();
        $user -> verified = true;
        $user-> confirmation_code = null;
        $user -> save();
        return redirect('/');
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
        return response()->json(User::find($id));
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
        User::destroy($id);
        return response()->json(['success' => true]);
    }
}
