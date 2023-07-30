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
        'change_request_id'
        ];

    // Comment belongs to ChangeRequest (Many-to-One)
    public function changeRequest() {
        return $this->belongsTo(ChangeRequest::class);
    }

    // Comment belongs to User (Many-to-One)
    public function user() {
        return $this->belongsTo(User::class);
    }
}
