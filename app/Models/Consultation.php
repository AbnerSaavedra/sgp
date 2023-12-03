<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $primaryKey = 'medicalHistoryId';

    protected $fillable = [
        'medicalHistoryId',
        'reason',
        'dateConsultation',
        'prescriptions',
        'nextConsultation',
    ];
}
