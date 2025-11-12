<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'assigned_by',
    ];

    public function assigned_to() {
        return $this -> belongsTo(User::class, 'assigned_to'
    }

    public function assigned_by() {
        return $this -> belongsTo(User::class, 'assigned_by');
    
    
}

}
