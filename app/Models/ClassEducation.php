<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassEducation extends Model
{
    use HasFactory;
    protected $table = 'class_education';
    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
    ];

    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
}