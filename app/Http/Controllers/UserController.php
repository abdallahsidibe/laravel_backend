<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {

        $userData = $request->validate([
            "username" => ["required", "string", "min:2", "max:255"],
            "name" => ["required", "string", "min:2", "max:255"],
            "email" => ["required", "email", "unique:users,email"],
            "password" => ["required", "string", "min:8", "max:30", "confirmed"]

        ]);

        $user = User::create([
            "username" => $userData["username"],
            "name" => $userData["name"],
            "email" => $userData["email"],
            "password" => bcrypt($userData["password"])
        ]);

        return response($user, 201);
     
    }

    public function login(Request $request)
    {
        $userData = $request->validate([
            "email" => ["required", "email"],
            "password" => ["required", "string", "min:8", "max:30"]
        ]);

        $user = User::where("email", $userData["email"])->first();
        if (!$user) {
            return response(["message" => "Aucun user trouvé avec l'email suivant $userData[email]"], 401);
        }

        if(!Hash::check($userData["password"], $user->password)){
            return response(["message" => "Aucun user trouvé avec ce mot de passe"], 401);

        }

         return response($user, 201);
    }
}
