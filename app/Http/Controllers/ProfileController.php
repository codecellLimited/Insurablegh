<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\HttpResponses;
use App\Http\Controllers\Auth\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    use HttpResponses;

    //Show User Profile


    public function profile(Request $request){
        
        $user = $request->user();
        
        return $this->success([
            'user' => $user
        ]);
    }


    //edit User Profile
    
    
    public function EditProfile(Request $request){

        $request->validate([
            'image' => 'required|image|max:5120',   //store img size= 5MB
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $msg = "record Updated successfully.";
        try{

            $users = $request->user();
            $users->image = $request->image->store('image','public');
            $users->save();

            $user = User::find($users->id)->update([
                'name'=> $request->first_name." ".$request->last_name,
                'phone'=> $request->phone,
                'username'=> $request->username,
                'image'=> \Storage::url($users->image),
                
            ]);

        }
        catch(\Exception $e){
            $msg = $e->getmessage();
        }

        
        return $this->success([
            'user' =>$users
            ], $msg);
    } 
    
    /**change Passwosrd for user*/

    public function ChangePassword(Request $request){
        
        $msg = "Password Changed successfully";
        $validator = Validator::make($request->all(), [
           
            'old_password' => 'required',
            'password' =>  ['required','confirmed', Password:: min(8)->letters()->numbers()->mixedcase()]
        ]);


    
        if($validator->fails()){
            return $this->error([], $validator->errors()->first());
        }

        $user = $request->user();
    
        if(Hash::check($request->old_password, $user->password)){
            $msg = "Password Changed successfully";
            
            User::find($user->id)->update([
                'password' => bcrypt($request->password),
            ]);
        }

        else{
           $msg = "Old password doesn't matched.";
            return $this->error([], $msg);
        }

        return $this->success([
            'user' => $user,
        ], $msg);
    }

}
