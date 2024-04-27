<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasFactory, HasRoles;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'roles_name',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'roles_name' => 'array',
    ];















    protected $appends = ['image_url'];

    const upload_distination = '/uploads/images/users/';
    const getImageDest = 'app/public/uploads/images/users/';


    // public function setImageAttribute($value)
    // {
    //     if (!$value instanceof UploadedFile) {
    //         $this->attributes['image'] = $value;
    //         return;
    //     }
    //     $image_name = $this->quickRandom();
    //     $image_name = $image_name . '.' . $value->getClientOriginalExtension(); // add the extention
    //     $value->move(public_path($this->upload_distination), $image_name);
    //     $this->attributes['image'] = $image_name;
    // }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }


        return strpos($this->image, 'http') !== false ? $this->image : asset(User::getImageDest . $this->image);
    }
    public static function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
}
