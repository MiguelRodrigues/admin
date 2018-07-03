<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use Validator, DB, Hash, Mail;
use App\User;


class AuthController extends Controller
{
    
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
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
            'access_token' => $token,
            'user'=> $this->guard()->user(),
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
    public function guard(){
        return \Auth::Guard('api');
    }

    public function get($id)
    {
        $user = User::whereId($id)->first();
        return response()->json([
            "customer" => $user
        ], 200);
    }

    public function allUsers()
    {
        $users = User::all();
        return response()->json([
            "users" => $users
        ], 200);
    }

    public function register(CreateUserRequest $request)
    {
        $credentials = $request->only('name', 'email', 'password');

        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users'
        ];

        $validator = Validator::make($credentials, $rules);

        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()]);
        }

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        
        $user = User::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password)]);

        return response()->json([
            "user" => $user
        ], 200);
    }
    public function edit(EditUserRequest $request, $id)
    {
       
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $user->password;
        $user->save();
        

        return response()->json([
            "user" => $user
        ], 200);
    }
}
