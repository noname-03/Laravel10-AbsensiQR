<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendances extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    protected $fillable = [
        'schedule_id',
        'status',
        'note',
        'file',
    ];


    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}