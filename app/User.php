<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    const IS_BAN = 1;
    const IS_ACTIVE = 0;

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

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function add($fiels)
    {
        $user = new static;
        $user->fill($fiels);
        $user->password = bcrypt($fiels['password']);
        $user->save();

        return $user;
    }

    public function edit($fiels)
    {
        if ($fiels->input('password')){$this->password = bcrypt($fiels->input('password'));}
        $this->name = $fiels->input('name');
        $this->email = $fiels->input('email');
        $this->save();
    }

    public function remove()
    {
        Storage::delete('uploads/'.$this->avatar);
        $this->delete();
    }

    public function uploadAvatar($image)
    {

        if($image == null){return;}
        if ($this->avatar !== null){
            Storage::delete('uploads/'.$this->avatar);
        }
        $filename = str_random(10).'.'.$image->extension();
        $image->storeAs('uploads',$filename);
        $this->avatar = $filename;
        $this->save();
    }

    public function getImage()
    {
        if ($this->avatar == null){
            return '/img/no-user-image.png';
        }
        else return '/uploads/'.$this->avatar;
    }

    public function makeAdmin()
    {
        $this->is_admin = 1;
        $this->save();
    }

    public function makeNormal()
    {
        $this->is_admin = 0;
        $this->save();
    }

    public function toggleAdmin($value)
    {
        if ($value == null){
            $this->makeNormal();
        }
        else $this->makeAdmin();
    }

    public function ban()
    {
        $this->status = User::IS_BAN;
        $this->save();
    }

    public function unban()
    {
        $this->status = User::IS_ACTIVE;
        $this->save();
    }
    public function toggleBan($value)
    {
        if ($value == null){
            $this->unban();
        }
        else $this->ban();
    }

    public function uploadGoogleImage($image)
    {
        $url = $image;
        $contents = file_get_contents($url);
        $name = str_random(10).basename($url);
        Storage::put('uploads/'.$name, $contents);
        return $name;
    }

}
