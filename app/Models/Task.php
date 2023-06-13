<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    const COMPLETED = 1;
    const NOT_COMPLETED = 2;

    protected $fillable = [
        'title',
        'description',
        'assigned_user',
        'due_date',
        'status',
        'deleted_at'
    ]; 

    protected $attributes = [
        'status' => self::NOT_COMPLETED,
    ];

    public function user() {
        return $this->belongsTo(User::class, 'assigned_user') ;
    }

    public function scopeAssignedUser($query, $id) {
        return $query->where('assigned_user', $id);
    }

    public function dateString()
    {
        return date('d-m-Y', strtotime($this->due_date));
    }
}
