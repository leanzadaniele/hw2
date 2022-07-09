<?php
namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    /* public function show($id)
    {
        return view('user.profile', [
            'user' => User::findOrFail($id)
        ]);
    } */

    public function showLogin(){
        return view('login');
    }

    public function controllaLogin(Request $request){
        $errors = [];
        $rules = [
            "email" => "required",
            "password" => "required",
        ];
        $validator = $request->validate($rules);

        $dataValidated = $validator;
        $user = new User();
        // Se esiste l'utente per email e password
        $user = $user->existForEmailAndPassword($dataValidated['email'], $dataValidated['password']);

        if($user != null && !empty($user)){
            /* Settaggio variabile di sessione */
            Session::put('user', $user);

            return redirect()->route('home');
        }else{
            return back()->withError("Utente non esistente")->withInput();
        }
        view('login');
    }
    public function logout(){
        Session::forget('user');
        return redirect()->route('login');
    }
}
