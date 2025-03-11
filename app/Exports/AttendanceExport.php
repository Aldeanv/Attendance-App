<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Attendance::select('nama', 'nip', 'dinas', 'email', 'telepon', 'waktu_kehadiran')->get();
    }

    public function headings(): array
    {
        return ["Nama", "NIP", "Dinas", "Email", "Telepon", "Waktu Kehadiran"];
    }
}
