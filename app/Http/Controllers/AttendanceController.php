<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\Participants;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        // Ambil peserta yang sudah absen
        $attendance = Attendance::when($search, function ($query) use ($search) {
            return $query->where('nama', 'like', "%{$search}%")
                         ->orWhere('nip', 'like', "%{$search}%");
        })->get();
    
        // Dapatkan NIP peserta yang sudah absen
        $attendedIds = $attendance->pluck('nip')->toArray();
    
        // Ambil peserta yang belum absen langsung dari database
        $notAttended = Participants::whereNotIn('nip', $attendedIds)->get();
    
        return view('attendance', compact('attendance', 'notAttended'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttendanceRequest $request)
    {        
        $request->validate([
            'qr_data' => 'required|string',
        ]);
    
        // Decode QR data
        $qrData = json_decode($request->qr_data, true);
    
        // Cek apakah NIP ada di tabel participants
        $participant = Participants::where('nip', $qrData['nip'])->first();
    
        if (!$participant) {
            return response()->json(['message' => 'Peserta tidak terdaftar pada acara!'], 400);
        }
    
        // Cek apakah peserta sudah absen hari ini
        $sudahAbsen = Attendance::where('nip', $qrData['nip'])
            ->whereDate('waktu_kehadiran', now()->toDateString())
            ->exists();
    
        if ($sudahAbsen) {
            return response()->json(['message' => 'Peserta sudah absen hari ini!'], 409);
        }
    
        // Simpan data ke tabel attendance
        Attendance::create([
            'nama' => $qrData['nama'],
            'nip' => $qrData['nip'],
            'dinas' => $qrData['dinas'],
            'email' => $qrData['email'],
            'telepon' => $qrData['telepon'],
            'waktu_kehadiran' => now(),
        ]);
    
        return response()->json(['message' => 'Absen berhasil!'], 200);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }

    public function destroyAll()
    {
        Attendance::truncate(); // Menghapus semua data di tabel attendance
        return redirect()->route('attendance.index')->with('success', 'Semua data kehadiran berhasil dihapus!');
    }
}
