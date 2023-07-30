<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'password' => 'hashed',
    ];

    // User has many Role_Users (Many-to-Many)
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    // User has many Requests (One-to-Many)
    public function changeRequests()
    {
        return $this->hasMany(ChangeRequest::class);
    }

    // User has many Comments (One-to-Many)
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // User has many Approvers (One-to-Many)
    public function approvers()
    {
        return $this->hasMany(Approver::class);
    }

    // User has many Request_types (One-to-Many)
    public function requestTypes()
    {
        return $this->hasMany(RequestType::class);
    }

    public function approvalLevels()
    {
        return $this->belongsToMany(ApprovalLevel::class, 'approval_levels_users');
    }

    public function getRedirectRoute()
    {
        if ($this->hasRole('Admin')) {
            return "/dashboard";
        } else {
            return "/change_requests";
        }
    }
}
