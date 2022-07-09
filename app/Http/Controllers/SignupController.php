<?php 
namespace App\Http\Controllers;
 
use App\Models\User;
use App\Http\Controllers\Controller;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
 
class SignupController extends Controller
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
    
    public function showSignup(){
        return view('register');
    }

    public function saveRegistration(Request $request){
        $rules = [
            "username" => "required",
            "name" => "required",
            "surname" => "required",
            "email" => "required",
            "password" => "required",
            "passcheck" => "required"
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){   
            throw new Exception($validator->errors(), 404);
        }
        $dataValidated = $validator->valid();
        $user = new User();
        // Se esiste l'utente per email
        if($user->existForEmail($dataValidated['email'])){
            return back()->withError("Utente già esistente!")->withInput();
        }else{
            $user = $user->create($dataValidated);
            if($user){
                /* return redirect()->route('registration')->withErrors(__('Utente già esistente!')); */
                return redirect()->route('home');
            }
        }
        /* dd($request->all()); */
    }
}