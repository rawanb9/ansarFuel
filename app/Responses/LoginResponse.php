<?php


namespace App\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseMain;
use Symfony\Component\HttpFoundation\Response;

class LoginResponse implements LoginResponseMain
{

    /**
     * @inheritDoc
     */
    public function toResponse($request): JsonResponse|Response|RedirectResponse
    {
        $user=Auth::user();
        $user->last_login = now();
        $user->save();

        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect()->intended(config('fortify.home'));
    }
}
