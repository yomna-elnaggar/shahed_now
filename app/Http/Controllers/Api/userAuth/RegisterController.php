<?php

namespace App\Http\Controllers\Api\userAuth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Exception\ClientException;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Validation\ValidationException;
use Twilio\Rest\Client;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Laravel\Socialite\Facades\Socialite;


class RegisterController extends Controller
{


    public function register(RegisterRequest $request)
    {
        try{
            $newUser = $request->validated();
            $newUser['password'] = Hash::make($newUser['password']);
            $user = User::create($newUser);
            $success['success'] = true;
            $success['token'] = $user->createToken('user',['app:all'])->plainTextToken;
            $success['name'] = $user->name;
            $success['message'] = ('success');
            return response()->json($success, 200);

        }catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

      
    public function redirectToProvider($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }

        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (ClientException $exception) {
            return response()->json(['error' => 'Invalid credentials provided.'], 422);
        }

        $userCreated = User::firstOrCreate(
            [
                'email' => $user->getEmail()
            ],
            [
                'email_verified_at' => now(),
                'name' => $user->getName(),
                
            ]
        );
        $userCreated->providers()->updateOrCreate(
            [
                'provider' => $provider,
                'provider_id' => $user->getId(),
            ],
            [
                'avatar' => $user->getAvatar()
            ]
        );

            $success['success'] = true;
            $success['token'] = $userCreated->createToken('user',['app:all'])->plainTextToken;
            $success['user'] = $userCreated;
            $success['message'] = ('success');
            return response()->json($success, 200);
    }

    /**
     * @param $provider
     * @return JsonResponse
     */
    protected function validateProvider($provider)
    {
        if (!in_array($provider, ['facebook', 'github', 'google'])) {
            return response()->json(['error' => 'Please login using facebook, github or google'], 422);
        }
    }
    }

    
    
    

    

