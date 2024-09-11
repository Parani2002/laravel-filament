<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable =[
        'first_name',
        'last_name',
        'grade_id',
        'user_id',
        

    ];
    public function grade():BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }
    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class);
    }
}
