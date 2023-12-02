<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
    use HasFactory;

    protected $primaryKey = 'patientId';

    protected $fillable = [
        'idHistory',
        'openingDate',
        'patientId',
        'personalBackground',
        'familyHistory'
    ];
}
