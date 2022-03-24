<?php

namespace App\Services\Access;

use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Class Access.
 */
class Access
{
    /**
     * Get the currently authenticated user or null.
     */
    public function user()
    {
        return auth()->user();
    }

    /**
     * Return if the current session user is a guest or not.
     *
     * @return mixed
     */
    public function guest()
    {
        return auth()->guest();
    }

    /**
     * @return mixed
     */
    public function logout()
    {
        return auth()->logout();
    }

    /**
     * Get the currently authenticated user's id.
     *
     * @return mixed
     */
    public function id()
    {
        return auth()->id();
    }

    /**
     * @param Authenticatable $user
     * @param bool            $remember
     */
    public function login(Authenticatable $user, $remember = false)
    {
        return auth()->login($user, $remember);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function loginUsingId($id)
    {
        return auth()->loginUsingId($id);
    }
}