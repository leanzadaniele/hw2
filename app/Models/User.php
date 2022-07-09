<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guarded = ['id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'name',
        'surname',
        'email',
    ];
    /*Per impostazione predefinita, laravel si aspetterà le colonne: 
        - create_at 
        - update_at 
        nella mia tabella. Impostandolo su false, sovrascriverà 
        l'impostazione predefinita.
    */
    public $timestamps = false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    public function admin(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this ->hasOne('App\Models\Admin');
    }

    public function likes()
    {
        return $this ->belongsTo('App\Models\Likes','id','user_id');
    }

    
    public function comments()
    {
        return $this ->belongsTo('App\Models\Comment','id','user_id');
        /* return $this ->belongsToMany('App\Models\Post','comments','user_id','post_id'); */
    }
    
    public function posts()
    {
        return $this ->belongsTo('App\Models\Post','id','author');
    }
    
    /**
     * Controlla se l'utente esiste nel db tramite Email ritorna true/false
     * 
     * @param email $email Email per poter controllare l'utente
     */
    public function existForEmail(string $email){
        return (User::all()->where('email', '=', $email)->count() > 0) ? true : false ;
    }
    /* 
        Ritorna L'oggetto stesso di user
    */
    public function findForEmail(string $email){
        return User::all()->where('email', '=', $email)->first();
    }

    /**
     * Controlla se l'utente esiste con email e password
     * 
     * @param email $email Email per poter controllare l'utente
     */
    public function existForEmailAndPassword(string $email, string $password){
        return User::all()
            ->where('email', '=', $email)
            ->where('password', '=', $password)->first();
    }

    public function isAdmin(){
        return Admin::all()
            ->where('admin_email', '=', $this->email)->count() > 0 ? true : false;
    }

}
?>
