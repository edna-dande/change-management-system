<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'request_id',
        'reason',
        'approval_request_id'
        ];


    public function request() {
        return $this->belongsTo(ChangeRequest::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function approval() {
        return $this->belongsTo(Approval::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }
}
