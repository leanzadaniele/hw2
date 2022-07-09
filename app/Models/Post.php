<?php

namespace App\Models;

use App\Models\User;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    protected $guarded = ['id'];
    public function admins(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this ->belongsTo('App\Models\Admin','admins');
    }

    public function likes()
    {
        return $this ->belongsTo('App\Models\Likes','id','post_id');
        /* return $this ->belongsToMany('App\Models\User','likes','post_id','user_id'); */
    }

    public function comments()
    {
        return $this ->belongsTo('App\Models\Comment','id','post_id');
    }

    public function getAuthorName(){
        return User::find($this->author)->username;
    }

    public $timestamps = false;
}
?>
