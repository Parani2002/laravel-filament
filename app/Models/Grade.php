<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grade extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable =[
        'grade_name',
        'grade_group',
        'grade_order',
        'grade_color',
       
    ];
    public function students():HasMany
    {
        return $this->hasMany(Student::class);
    }
    
    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class);
    }
}
