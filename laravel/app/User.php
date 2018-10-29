<?php

// User.php Model

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function watchlist(){                                            //Relatie tussen user & movie tabel gecreeerd.
        return $this ->hasMany('App\Watchlist');                        //Één heeft meerdere movie namen.
    }

    public function posts(){                                            //Relatie tussen User en Post tabel gecreeerd.                         
        return $this->hasMany('App\Post');                              //Één User heeft meerdere (hasmany) Posts
    }

    public function movies(){                                           //Relatie tussen user & movie tabel gecreeerd.
        return $this ->hasMany('App\Movie');                            //Één heeft meerdere movie namen.
    }

}
