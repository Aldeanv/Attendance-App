<?php

namespace App\Imports;

use App\Models\Participants;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ParticipantsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Participants([
            'nama'          => $row['nama'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'dinas'         => $row['dinas'],
            'jabatan'       => $row['jabatan'],
            'nip'           => $row['nip'],
            'email'         => $row['email'],
            'telepon'       => $row['telepon'],
        ]);
    }
}
