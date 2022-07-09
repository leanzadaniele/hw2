<?php 
namespace App\Http\Controllers;
 
use Exception;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
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
    
    public function showProfile(){
        $isLogged = Session::get('user');
        
        /* if($isLogged == null){
            return redirect()->route('login');
        } */

        $user = $isLogged;
        
        return view('profile', compact('user'));
    }
    
    public function logout(){
        Session::forget('user');
        return redirect()->route('login');
    }
}