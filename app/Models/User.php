<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;


class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nickname',
        'email',
        'password',
        'role',
        'gender',
        'tanggal_lahir',
        'avatar',
        'total_score'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relasi ke progress quiz user.
     */
    public function quizProgress()
    {
        return $this->hasMany(UserQuizProgress::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

public function getAvatarUrlAttribute(): string
{
    if (!$this->avatar || $this->avatar === 'avatars/default.jpg') {
        return asset('storage/avatars/default.jpg');
    }

    return Storage::disk('b2')->temporaryUrl(
        $this->avatar,
        now()->addMinutes(30)
    );
}

}
