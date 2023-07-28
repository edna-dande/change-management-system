<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
        'request_id'
        ];

    // Comment belongs to Request (Many-to-One)
    public function request() {
        return $this->belongsTo(Request::class);
    }

    // Comment belongs to User (Many-to-One)
    public function user() {
        return $this->belongsTo(User::class);
    }
}
