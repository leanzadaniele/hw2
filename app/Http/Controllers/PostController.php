<?php 
namespace App\Http\Controllers;
 
use Exception;
use App\Models\User;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    
    public function showNewPost(){
        $user = Session::get('user');
        if($user == null || !$user->isAdmin()){
            return redirect()->route('login');
        }

        return view('new_post', compact('user'));
    }

    public function savePost(Request $request){
        $user = Session::get('user');
        if($user == null || !$user->isAdmin()){
            return redirect()->route('login');
        }
        $data = $request->all();
        if($data != null && !empty($data['content'])){
            $newPost =  new Post();
            $newPost->author = $user->id;
            $newPost->content = $data['content'];
            if($newPost->save()){
                return redirect()->route('admin_home');
            }
            
        }

        return view('new_post', compact('user'));
    }

}
