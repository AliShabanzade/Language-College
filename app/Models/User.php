<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, InteractsWithMedia, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'block', 'mobile', 'password', 'email', 'mobile_verify_at', 'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    public function registerMediaCollections(Media $media = null): void
    {

        $this->addMediaCollection('avatar')
             ->singleFile()
             ->registerMediaConversions(
                 function (Media $media) {
                     $this->addMediaConversion('100_100')
                          ->crop(Manipulations::CROP_CENTER, 400, 400);
                     $this->addMediaConversion('200_200')
                          ->crop(Manipulations::CROP_BOTTOM_LEFT, 400, 400);
                     $this->addMediaConversion('512_512')
                          ->crop(Manipulations::CROP_TOP, 400, 400);
                 });

        $this->addMediaCollection('cart_melli')
             ->singleFile()
             ->registerMediaConversions(
                 function (Media $media) {
                     $this->addMediaConversion('100_150')->crop(Manipulations::CROP_CENTER, 100, 150);
                     $this->addMediaConversion('400_500')->crop(Manipulations::CROP_CENTER, 400, 500);
                 });

        $this->addMediaCollection('shenasname')
             ->singleFile()
             ->registerMediaConversions(
                 function (Media $media) {
                     $this->addMediaConversion('100_150')->crop(Manipulations::CROP_CENTER, 100, 150);
                     $this->addMediaConversion('400_500')->crop(Manipulations::CROP_CENTER, 400, 500);
                 });

        $this->addMediaCollection('cover')
             ->singleFile()
             ->registerMediaConversions(
                 function (Media $media) {
                     $this->addMediaConversion('1080')->crop(Manipulations::CROP_CENTER, 1080, 400);
                 });
    }


    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function notices(): HasMany
    {
        return $this->hasMany(Notice::class);
    }


    public function activationCodes(): HasMany
    {
        return $this->hasMany(ActivationCode::class);
    }


    public function opinion(): HasMany
    {
        return $this->hasMany(Opinion::class);
    }

    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }

}
