<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\NewAccessToken;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{
    /**
     * Show user details.
     *
     * @param User $user The user to retrieve details for.
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return response()->json($user);
    }

    /**
     * Log a user out by revoking their tokens.
     *
     * @param Request $request The HTTP request object.
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        // Delete all tokens associated with the user.
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'User logged out successfully']);
    }

    /**
     * Register a new user.
     *
     * @param RegistrationRequest $request The request containing user registration data.
     * @return JsonResponse
     */
    public function register(RegistrationRequest $request): JsonResponse
    {
        // Create a new user record with the provided registration data.
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        // Generate a new access token for the user.
        $token = $this->getToken($user)->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token], ResponseAlias::HTTP_CREATED);
    }

    /**
     * Generate a new access token for a user.
     *
     * @param User $user The user for whom the token is generated.
     * @return NewAccessToken
     */
    public function getToken(User $user): NewAccessToken
    {
        return $user->createToken('authToken');
    }

    /**
     * Log a user in.
     *
     * @param LoginRequest $request The request containing user login data.
     * @return JsonResponse
     * @throws ValidationException
     */
    public function login(LoginRequest $request): JsonResponse
    {
        // Attempt to authenticate the user with the provided credentials.
        if (! Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Retrieve the authenticated user and generate a new access token.
        $user = $request->user();
        $token = $this->getToken($user)->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token]);
    }
}
