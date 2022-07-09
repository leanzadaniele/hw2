<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Model {
    public $timestamps = false;
    /* protected $guarded = ['id']; */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this ->belongsTo('App\Models\User','id');
    }

    public function post(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this ->hasMany('App\Models\Post','posts');
    }

    public static function getAdminForID($id){
        return Admin::where('id', '=', $id)->first();
    }
}

