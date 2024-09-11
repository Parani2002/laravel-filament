<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable =[
        'subject_name',
        'subject_order',
        'color',
        
    ];
 
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class);
    }
    public function grade(): BelongsToMany
    {
        return $this->belongsToMany(Grade::class);
    }
}
