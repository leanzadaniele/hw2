<?php
namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use App\Models\User;
use App\Models\Likes;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostFetchController extends Controller
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
    public function getPosts(){

        /* return Post::select('posts.id as id_post', 'username as author', 'posts.content')
        ->join('admins', 'posts.author', '=', 'admins.id')
        ->join('users', 'users.id', '=', 'admins.id')->get()->toJson(); */
        return Post::all()->map(function($post){
            return ['id_post' => $post->id, 'author' => $post->getAuthorName(), 'content' => $post->content];
        })->toJson();
        /* return $user->posts()->get()->map(function($post){
            return ['id_post' => $post->id, 'author' => $post->author, 'content' => $post->content];
        })->toJson(); */
    }
    public function isLiked(){
        $user = Session::get('user');
        return $user->likes()->get()->map(function($like){
            return ['post_id' => $like->post_id];
        })->toJson();
        /* return Likes::select('post_id')
            ->where('user_id', '=', Session::get('user')->id)
            ->get()->toJson(); */
    }
    /* To Do */
    public function getComments(Request $request, $id){
        if(isset($id)){
            $post = Post::find($id);
        /* dd($post->comments()->get()); */

        /* foreach($post->comments()->get() as $com){
            $usr = $com->user()->first();
            dd(['id_post' => $com->post_id, 'author' => $post->author, 'content' => $post->content, 'propic' => $usr->propic, 'comment' => $com->comment]);
        } */
        $arr = [];
        $posts = $post->comments()->get()->map(function($com) use ($post){
            $usr = $com->user()->first();
            return ['id_post' => $com->post_id, 'author' => $com->getUserName(), 'content' => $post->content, 'propic' => $usr->propic, 'comment' => $com->comment];
        });
        foreach($posts as $post){

            $post['propic'] = trim($post['propic'], "\'");
            $arr[] = [
                "id" => $id,
                "comments" => [
                    'id' => $post['id_post'],
                    'username' => $post['author'],
                    'comment' => $post['comment'],
                    'propic' => $post['propic']
                ]
            ];
        }

        return json_encode($arr);
            /* $arr = [];
            $posts = Post::select('posts.id as id_post', 'username as author', 'posts.content', 'users.propic', 'comments.comment')
                ->join('comments', 'posts.id', '=', 'comments.post_id')
                ->join('users', 'users.id', '=', 'comments.user_id')
                ->where('posts.id', '=', $id)->get();

                foreach($posts as $post){
                    $post->propic = trim($post->propic, "\'");
                    $arr[] = [
                        "id" => $id,
                        "comments" => [
                            'id' => $post->id,
                            'username' => $post->author,
                            'comment' => $post->comment,
                            'propic' => $post->propic
                        ]
                    ];
                }

                return json_encode($arr);
                 */
        }else{
            echo "error";
        }
    }
    /* Da eliminare a quanto pare non viene usato. Da un-comment se è usato */
    /* public function fetchComments(){

        return Post::select('posts.id as id_post', 'username as author', 'posts.content')
        ->join('comments', 'posts.id', '=', 'comments.post_id')
        ->join('users', 'users.id', '=', 'comments.user_id')
        ->where('posts.id', '=', $id)->get()->toJson();
    } */
    public function getLikes(Request $request, $id){
        // TO DO --> Da visionare
        $likeCount = [];
        $nLines = Post::find((int)$id)->likes()->get()->count();
        /* $nLines = Likes::all()->where('post_id', '=', $id)->count(); */
        $likeCount[] = ["id" => $id, "numLikes" => $nLines];
        return $likeCount;
    }
    public function setLike(Request $request, $post_id, $user_id){
        /* $likes = Likes::where('post_id', '=', $post_id)->where('user_id', '=', $user_id); */
        $user = User::find((int)$user_id);
        $likes = $user->likes()->get()->filter(function($like) use ($post_id){
            return $like->post_id == (int)$post_id;
        });

        if($likes->count() == 0){
            $newLike = new Likes();
            $newLike->post_id = $post_id;
            $newLike->user_id = $user_id;
            if($newLike->save()){
                echo "ok insert";
            }

        }else{

            if($likes->first()->delete()){
                echo "ok delete";
            }
        }

    }
    public function getUserLogged(){
        // Prende L'utente dalla sessione
        $user = Session::get('user');
        // Se esso esiste (quindi è Loggato) allora ritorna l'id
        return ($user != null && !empty($user)) ? $user->id : 0;
    }
    /* Questo non Viene usato. Quindi da cancellare. vedere se effettivamente è così */
    /* public function response(){
        $final = [];
        $posts = Post::select('posts.id as id_post', 'username as author', 'posts.content')
            ->join('admins', 'posts.author', '=', 'admins.id')
            ->join('users', 'users.id', '=', 'admins.id')->get();

        return $posts->toJson();
    } */

    public function getMyComments(){
        /* Prendo l'utente dalla sessione */
        $user = Session::get('user');
        return $user->comments()->get()->map(function($comment){
            /* ('id', 'post_id', 'comment') */
            return ['id' => $comment->id, 'post_id' => $comment->post_id, 'comment' => $comment->comment];
        })->toJson();
        /* return Comment::select('id', 'post_id', 'comment')->where('user_id', '=', Session::get('user')->id)->get()->toJson(); */
    }
    public function deleteMyComment(Request $request, $post_id){
        $user = Session::get('user');
        /* $deleted = Comment::where('id', '=', (int)$post_id)->where('user_id', '=', Session::get('user')->id)->first(); */
        $deleted = $user->comments()->get()->filter(function($comment) use ($post_id){
            return $comment->id == $post_id;
        })->first();
        if($deleted->delete()){
            return json_encode("delete ok");
        }else{
            return json_encode("delete error");
        }
    }
    public function phpProfilePicture(Request $request, $q){
        if(isset($q)){
            $encoded = urlencode($q);

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://api.unsplash.com/search/photos?per_page=5&query=".$encoded."&client_id=PzE5KZG0PwNUguSq4EQI7uYb2ZmIJUO9O5BFYWFbMmI",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
            ]);

            $response = curl_exec($curl);

            $err = curl_error($curl);

            curl_close($curl);
            // Se c'è un errore
            if (!empty($err)) {
                echo "cURL Error #:" . $err;
            } else {
                // Non trasformo in json perché tanto l'api rest mi ritorna già un json e quindi lo stampo e basta
                echo $response;
            }
        }
    }

    public function changeProfilePicture(Request $request, $id){
        $imgUrl = $_GET["imgUrl"];
        if(isset($imgUrl)){
            $user = Session::get('user');
            $user->propic = "'".$imgUrl."'";
            if($user->save()){
                echo "ok";
            }else{
                echo "err";
            }
        }
    }

    public function deleteMe(){
        $user = Session::get('user');
        if($user != null && !empty($user)){
            if($user->delete()){
                redirect()->route('login');
            }
        }
        return redirect()->route('login');
    }

    public function myPosts(){
        /* select id, content from posts where author = $me" */
        $user = Session::get('user');
        return $user->posts()->get()->map(function($post){
            return ['id' => $post->id, 'content' => $post->content];
        })->toJson();
        /* return Post::select('id', 'content')->where('author', '=', Session::get('user')->id)->get()->toJson(); */
    }

    public function deletePost(Request $request, $post_id){
        $user = Session::get('user');
        /* $deleted = Post::where('author', '=', Session::get('user')->id)->where('id', '=', $post_id)->first(); */
        /* Con Filter cerco l'elemento con quell'id e lo ritorno con first. Perché essendo una chiave primaria so già che sarà singolo */
        $deleted = $user->posts()->get()->filter(function($post) use ($post_id){
            return $post->id == $post_id;
        })->first();
        if($deleted->delete()){
            return json_encode("delete ok");
        }else{
            return json_encode("delete error");
        }
    }

    public function comment(Request $request, $comment, $user_id, $post_id){
        /* dd($comment); */
        /* dd($user_id); */
        /* dd($post_id); */
        if(isset($comment) && !empty($comment) && isset($user_id) && !empty($user_id) && isset($post_id) && !empty($post_id)){
            $com = new Comment();
            $com->comment = $comment;
            $com->user_id = $user_id;
            $com->post_id = $post_id;
            if($com->save()){
                echo "ok";
            }else{
                echo "ERROR";
            }
        }else{
            echo "ERROR";
        }
    }

    public function test(){
        $user = Session::get('user');
        /* dd($user->posts()->get()); */
        /* Funge */
        /* dd($user->posts()->get()); */
        /* dd($user->posts()->get()->map(function($post){
            return ['id_post' => $post->id, 'author' => $post->author, 'content' => $post->content];
        })); */

        /* dd($user->posts()->get()->map(function($post){
            return ['id' => $post->id, 'content' => $post->content];
        })); */
        /* $id = 5;
        dd($user->comments()->get()->filter(function($comment) use ($id){
            return $comment->id == $id;
        })->first());
 */
        /* setLike */
        /* $likes = Likes::where('post_id', '=', $post_id)->where('user_id', '=', $user_id); */
        /* $post_id = 1;
        $user = User::find(1);
        dd($user->likes()->get()->filter(function($post) use ($post_id){
            return $post->id == $post_id;
        })); */

        /* Post::select('posts.id as id_post', 'username as author', 'posts.content', 'users.propic', 'comments.comment')
                ->join('comments', 'posts.id', '=', 'comments.post_id')
                ->join('users', 'users.id', '=', 'comments.user_id')
                ->where('posts.id', '=', $id)->get();
 */

        /* dd(Post::all()); */

        $user_id = 1;
        $post_id = 1;
        $user = User::find((int)$user_id);
        $likes = $user->likes()->get()->filter(function($like) use ($post_id){
            return $like->post_id == (int)$post_id;
        });

        /* dd($user->likes()->get()->filter(function($like) use ($post_id){
            return $like->post_id == $post_id;
        })); */
        /* dd(Post::find(1)->likes()->get()->count()); */
        /* dd($user->comments()->get()->map(function($comment){

            return ['id' => $comment->id, 'post_id' => $comment->post_id, 'comment' => $comment->comment];
        })); */
        /* return $user->likes()->get()->map(function($post){
            return ['post_id' => $post->id];
        })->toJson(); */

        /* foreach($user->comments()->get() as $post){
            dd($post->comments()->get()[0]);
        } */
    }

}
