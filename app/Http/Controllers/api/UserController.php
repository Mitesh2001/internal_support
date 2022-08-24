<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Ramsey\Uuid\Uuid;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'Wrong Email/Password', 'status' => 'FAIL']);
            }
        } catch (JWTException $e) {
            return response()->json(['message' => 'could_not_create_token', 'status' => 'FAIL'], 500);
        }

        $user = JWTAuth::user();

        $user->token = $token;

        $user->save();

        return response()->json(['user' => $user, 'status' => 'SUCCESS', 'message' => 'Login Successfull']);
    }

    public function getAuthenticatedUser()
    {

        $user = $this->getUserData();

        unset($user->token);

        return response()->json([
            'status' => 'SUCCESS',
            'user' => $user,
            'message' => ''
        ]);

    }

    public function getUserData()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json([
                    'status' => 'FAIL',
                    'message' => 'User not found.'
                ]);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        $user = User::where('id', $user->id)->first();

        return $user;
    }

    public function logout(Request $request)
    {

        $user = JWTAuth::parseToken()->authenticate();
        if ($user) {
            $user->token = null;
            $user->save();
        }

        try {
            JWTAuth::invalidate($request->input('token'));
            return response()->json([
                'status' => 'SUCCESS',
                'message' => "You have successfully logged out."
            ]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json([
                'status' => 'FAIL',
                'message' => 'Failed to logout, please try again.'
            ]);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required','confirmed','string',Password::min(6)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()],
        ]);

        if($validator->fails()){
            $errorString = implode(",", $validator->messages()->all());
            return response()->json([
                'status' => 'FAIL',
                'message' => $errorString //$validator->errors()->first()
            ]);
        }

        $profile_pic = "";

        if(!empty($request->profile_pic)) {
            $path = 'assets/employees/profile_pics/';
            $first_name  = strtolower(str_replace(' ', '_',$request->first_name));
            $profile_pic_name = User::createImageFromBase64($request->profile_pic, $first_name, $path);
            $profile_pic = $profile_pic_name;
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'profile_pic' => $profile_pic
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(['user' => $user, 'status' => 'SUCCESS', 'message' => 'Registration Successfull !'],201);

    }
}
