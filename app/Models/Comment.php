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

    public function changeRequest() {
        return $this->belongsTo(ChangeRequest::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
