<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;
use App\User;
use App\Http\Controllers\Traits\ResponserTrait;
use App\Http\Resources\LoginResource;
use Symfony\Component\Routing\RequestContext;
use App\ClassPackage;
class UsersController extends Controller
{
    use ResponserTrait;
    //
    public function createUserByFactory() {
        // return "HI";
        $user = factory(User::class)->create();
        return $this->respondCollection('successfully created a new user',new UserResource($user));
    }

    public function loginByUser(Request $request) {
        $data = $request->all();

        $user = new User();
        $user_data = $user->CheckUser($data['username'],$data['password']);
        if($user_data) {
            $user_data->token = $user_data->createToken('TutsForWeb')->accessToken;
            $user_data->username = $user_data->name;
            $user_data->id = $user_data->id;

            return $this->respondCollection('sucessfully logged In', new LoginResource($user_data));
        }else {
            return $this->respondErrorToken('Username or Password Wrong');
        }

    }

    public function test() {
        $package = factory(ClassPackage::class,6)->create();
        return $this->respondSuccessMsgOnly("Successfully Created Packages");
    }
}


