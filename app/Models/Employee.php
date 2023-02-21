<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'paternal_surname',
        'maternal_surname',
        'email',
        'phone',
        'workstation',
    ];

    public function subsidiaries()
    {
        return $this->belongsToMany(Subsidiary::class, 'assign_subsidiaries')->as('subsidiaries_assigned')->using(AssignSubsidiary::class);
    }
}
