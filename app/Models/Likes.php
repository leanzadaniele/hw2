<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Likes extends Model
{
    protected $guarded = ['id'];
    protected $primaryKey = 'post_id';
    /* public function admins(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this ->belongsTo('App\Models\Admin','admins');
    }

    public function likes(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this ->belongsToMany('App\Models\User','likes','post_id','user_id');
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this ->belongsToMany('App\Models\User','comments','post_id','user_id');
    } */

    public $timestamps = false;
}
?>
