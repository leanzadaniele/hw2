<?php
namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    /* public function isLogged(){
        $isLogged = Session::get('user');
        if($isLogged == null){
            return redirect()->route('login');
        }
    } */
    public function getUserLogged(){
        return Session::get('user');
    }
    public function showHome(){
        $isLogged = Session::get('user');
        if($isLogged == null){
            return redirect()->route('login');
        }

        $user = $this->getUserLogged();

        return view('home', compact('user'));
    }

}
