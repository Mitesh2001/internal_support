<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'description',
        'notes',
        'domains',
        'health_score',
        'account_tier',
        'renewal_date',
        'industry_id',
        'logo'
    ];

    public function notes()
    {
        return $this->morphMany(Note::class,'notesable');
    }

    public function todoes()
    {
        return $this->morphMany(Todo::class,'todoable')->latest();
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class,'company_id','id');
    }

}
