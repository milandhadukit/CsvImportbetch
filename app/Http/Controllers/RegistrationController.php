<?php

namespace App\Http\Controllers;


use App\Models\User;

use Illuminate\Http\Request;
use Session;
use Log;
class RegistrationController extends Controller
{
    //

    public function create()
    {
        return view('Register.register_create');
    }


    public function store()
    {
        try {
            $this->validate(request(), [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                // 'test'=> 'required',
            ]);

            $user = User::create(request(['name', 'email', 'password','test']));

            \Log::channel('errorLog')->info('Successfully Register');

              return redirect()->back();
           
        

        } catch (\Exception $e) {
           
           
            \Log::channel('errorLog')->error($e->getMessage());
            return $e->getMessage();
        
        //    return  \Log::channel('errorLog')->info($e->getMessage());
        }
    }
}


