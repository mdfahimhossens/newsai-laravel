<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
 use HasFactory;

 protected $guarded = [];

    protected $fillable = [
        'user_id',
        'title',
        'days',
        'timezone',
        'language',
        'section_name',
        'section_description',
    ];

    protected $casts = [
        'days' => 'array', // JSON → Array automatically
    ];

        public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
