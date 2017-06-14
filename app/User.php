<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

use Illuminate\Support\Facades\Hash;

class User extends Model implements AuthenticatableContract, AuthorizableContract {

    use Authenticatable, Authorizable;

    protected $fillable = ['id', 'name', 'email'];
    protected $hidden   = ['created_at', 'updated_at', 'password'];

    public function verify($email, $password){

    $user = User::where('email', $email)->first();

    if($user && Hash::check($password, $user->password)){
        return $user->id;
    }

    return false;
    }

}
