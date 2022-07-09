<?php
namespace App\Models;
use App\Models\User;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model {
    public $timestamps = false;
    protected $guarded = ['id'];
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this ->belongsTo('App\Models\User','user_id', 'id');
    }

    public function post(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this ->hasMany('App\Models\Post','posts');
    }


    public function getUserName(){
        return User::find($this->user_id)->username;
    }
    
}

