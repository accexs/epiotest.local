<?php namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class SessionsController extends Controller
{


    /**
     * Perform the login.
     *
     * @param  Request  $request
     * @return \Redirect
     */
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all()
                ]);
        }elseif(Auth::attempt($this->getCredentials($request))){
            //auth user and return response
            return response()->json([
                    'success' => true
                    ]);
        }

        return response()->json([
                    'success' => false
                    ]);
    }

    /**
     * Get the login credentials and requirements.
     *
     * @param  Request $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return [
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
            'verified' => true
        ];
    }

    /**
     * Destroy the user's current session.
     *
     * @return \Redirect
     */
    public function logout()
    {
        Auth::logout();

        return response()->json([
                'success' => true
                ]);
    }
}
