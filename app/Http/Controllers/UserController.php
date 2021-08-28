<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users to verify.
     *
     * @return Application|Factory|View
     */
    public function verifyUsersIndex(): Factory|View|Application
    {
        return view('user.verify-users',
            ['users' => User::all()->whereNull('email_verified_at')]
        );
    }

    /**
     * Display a listing of the users to verify.
     *
     * @return Application|Factory|View
     */
    public function UsersIndex(): Factory|View|Application
    {
        return view('user.index', ['users' => User::all()]);
    }

    /**
     *
     * @param User $user
     * @return string[][]
     */
    public function verifyUser(User $user): array
    {
        if($user->email_verified_at!=null){
            return ["error"=>"user already verified"];
        }
        $user->email_verified_at=now();
        $user->save();
        if($user->email_verified_at==null){
            return ["error"=>"user could not not be verified!"];
        }
        return ["success"=>["message"=>"Verified",
            "ver_at"=>date('Y-m-d H:i:s',strtotime($user->email_verified_at))]];
    }
    /**
     *
     * @param User $user
     * @return string[][]
     */
    public function unVerifyUser(User $user): array
    {
        if($user->email_verified_at==null){
            return ["error"=>"user already not verified"];
        }
        $user->email_verified_at=null;
        $user->save();
        if($user->email_verified_at!=null){
            return ["error"=>"user could not not be unverified!"];
        }
        return ["success"=>["message"=>"Unverified"]];
    }
}
