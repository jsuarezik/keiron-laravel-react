<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Http\JsonResponse;
use JWTAuth;
use Hash;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    
    function login(Request $request):JsonResponse
    {
        $credentials = $request->only(['email', 'password']);

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                throw new Exception('invalid_credentials');
            }
            
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        } catch( JWTException $e) {
            return response()->json(['message' => 'token_not_created'], 500);
        }

        return response()->json(['token' => $token], 200);
    }

    public function register(Request $request):JsonResponse
    {
        $data = $request->all();

        $user = User::create($data);

        if (!$user) {
            return response()->json(['message' => 'unexpected_error'],  500);
        }

        return response()->json($user, 201);
    }

    public function detail(Request $request):JsonResponse
    {
        $user = auth()->user();
        $user->load('role');

        return response()->json($user, 200);
    }
}
