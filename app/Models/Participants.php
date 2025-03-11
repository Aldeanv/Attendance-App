<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participants extends Model
{
    /** @use HasFactory<\Database\Factories\ParticipantsFactory> */
    use HasFactory;
    protected $fillable = [
        'nama', 'jenis_kelamin', 'dinas', 'jabatan',
        'nip', 'email', 'telepon'
    ];
}
