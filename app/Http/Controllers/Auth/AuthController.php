<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Events\TwoStepVerificationEvent;
use Auth;
class AuthController extends Controller
{
    public function __construct(){
        //$this->middleware('cors');
    }
    //
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(){
        $credentials=request(['email','password']);
        if(User::where('email',request('email'))->exists()){
            if(!Hash::check(request('password'),User::where('email',request('email'))->first()->password)){
                return response()->json(['status'=>false,'message'=>'Wrong Credentials'],403);
            }
            $data = array('name'=>User::where('email',request('email'))->first()->name);
            // Mail::send('mail', $data, function($message) {
            //     $message->to(request('email'), '')->subject('Test Mail from inventory management');
            //     $message->from(env('MAIL_FROM_ADDRESS'),'Stock Management 1.0');
            // });
            //event(new TwoStepVerificationEvent(User::where('email',request('email'))->first()));
            return response()->json(['status'=>true,'message'=>'An OTP has been sent to your email'],200);
        }
        else{
            return response()->json(['status'=>false,'message'=>'User does not exist'],403);
        }
    }
    public function OTP_verification(Request $request)
    {
        if(Hash::check($request->otp,User::where('email',request('email'))->first()->otp)){
            $credentials = request(['email', 'password']);
            if (! $token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            return $this->respondWithToken($token);
        }
        else{
            return response()->json(['status'=>false,'message'=>'Wrong OTP']);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::user()->forceFill([
            'otp'=>null
        ])->save();
        auth()->logout();
        return response()->json(['status'=>true,'message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'status'=>true,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
