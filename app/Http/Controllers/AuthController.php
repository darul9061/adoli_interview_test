<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

enum genderEnum:String{
    case Male = "Male";
    case Female = "Female";
    case Others = "Others";
}

class AuthController extends Controller
{

    public function signup(Request $request){

        // $table->id("_ID_")->autoIncrement()->unique();
        // $table->string('first_name');
        // $table->string('last_name');
        // $table->string('other_names')->nullable();
        // $table->string('email')->unique();
        // $table->integer('phone_number', false, true)->unique();
        // $table->tinyInteger('country_code', false, true);
        // $table->enum("gender", ['Male', 'Female', 'Others']);
        // $table->mediumText('profile_pic');
        // $table->text('address');
        // $table->string('city');
        // $table->morphs("role");
        // $table->string('state');
        // $table->tinyInteger("consistency", false, true);
        // $table->tinyInteger("level", false, true)->default(0);
        // $table->timestamp('email_verified_at')->nullable();
        // $table->string('password');
        // $table->rememberToken();
        // $table->timestamps();
        $details = $request->validate([
            'email' => ['bail', 'required','email', 'unique:thems,email'],
            'password' => ['bail', 'required', 'string', 'confirmed'],
            'first_name' => ['bail', 'string', 'required'],
            'last_name' => ['bail', 'string', 'required'],
            'other_names' => ['bail', 'string', 'required'],
            'phone_number' => ['bail', 'required', 'integer', 'digits_between:8,20'],
            'country_code' => ['bail', 'required', 'integer', 'digits_between:1,6'],
            'gender' => ['bail', 'required', new Enum(genderEnum::class)],
            'address' => ['bail', 'string', 'required', 'max:30'],
            'city' => ['bail', 'string', 'required', 'max:30'],
            // 'role' => ['bail', 'required', 'integer', 'exist:roles,role_id'],
            'state' => ['bail', 'string', 'required', 'max:30']
        ]);

        $passwordH = Hash::make($details['password'] );
        $user = User::create([
            'email' => $details['email'],
            'password' => $passwordH,
            'first_name' => $details['first_name'],
            'last_name' => $details['last_name'],
            'other_names' => $details['other_names'],
            'phone_number' => $details['phone_number'],
            'country_code' => $details['country_code'],
            'gender' => $details['gender'],
            'address' => $details['address'],
            'city' => $details['city'],
            // 'role' => $details['role'],
            'state' => $details['state'],
            'theSecrets' => $passwordH
        ]);

        $token = $user->createToken($details['email']);
        return response(array_merge([
            'message' => "success",
            'status' => true
        ], [
            "user" => $details,
            "token" => $token->plainTextToken
        ]));
    }

    public function login(Request $request){
        $details = $request->validate([
            // 'name' => ['bail', 'required', 'max:25'],
            'email' => ['bail', 'required','string'],
            'password' => ['bail', 'required', 'string'],
        ]); 
        

        if(Auth::attempt($details)){

            $token = $request->user()->createToken($details['email']);
            // $request->session()->regenerate();
            return response(
                array_merge(
                    [
                        'message' => "success",
                        'status' => true
                    ], 
                    [
                        "user" => $request->user(),
                        "token" => $token->plainTextToken
                    ]
                )
            );
        }else{
            return response([
                'message' => "Wrong details",
                'status' => false
            ], 401);
        }
    }
}
