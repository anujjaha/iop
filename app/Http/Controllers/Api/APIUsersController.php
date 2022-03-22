<?php

namespace App\Http\Controllers\Api;

use Auth;
use Response;
use Illuminate\Http\Request;
use App\Models\User\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Api\BaseApiController;
use Tymon\JWTAuthExceptions\JWTException;
use App\Http\Transformers\UserTransformer;

class APIUsersController extends BaseApiController
{
    protected $userTransformer;

    /**
     * __construct.
     */
    public function __construct()
    {
        //$this->userTransformer = new UserTransformer;
    }

    /**
     * Login request.
     *
     * @param Request $request
     * @return type
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $user = Auth::user();
        $user = User::with([])->where('id', $user->id)
            ->first()
            ->toArray();
        $userData = array_merge($user, ['token' => $token]);

        $responseData =(object) $userData;

        // if no errors are encountered we can return a JWT
        return $this->successResponse($responseData);
    }

    /**
     * Logout request.
     * @param  Request $request
     * @return json
     */
    public function logout(Request $request)
    {
        $userId = $request->header('UserId');
        $userToken = $request->header('UserToken');
        $response = $this->users->deleteUserToken($userId, $userToken);
        if ($response) {
            return $this->successResponse([]);
        } else {
            return $this->failureResponse('Error in Logout');
        }
    }
}
