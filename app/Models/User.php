<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    
    use HasFactory, Notifiable;

    
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
    ];

    public function getAvatarUrlAttribute(): ?string
    {
        $path = $this->avatar;
        if (!$path) {
            return null;
        }
        return \Illuminate\Support\Facades\Storage::disk('public')->url($path);
    }

    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
public function formateur()
{
    return $this->hasOne(Formateur::class);
}
}

