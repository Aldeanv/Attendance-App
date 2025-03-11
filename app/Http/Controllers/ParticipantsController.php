<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participants;
use App\Imports\ParticipantsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreParticipantsRequest;
use App\Http\Requests\UpdateParticipantsRequest;

class ParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        
        $participants = Participants::paginate(10);

        $search = $request->input('search');

        // Query peserta dengan filter pencarian jika ada
        $participants = Participants::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%$search%")
                         ->orWhere('nip', 'like', "%$search%");
        })->orderBy('id', 'desc')->paginate(10);

        return view ('participants',compact('participants'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new ParticipantsImport, $request->file('file'));
            return redirect()->back()->with('success', 'Data peserta berhasil diimpor.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan dalam mengimpor file.');
        }
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
    public function store(StoreParticipantsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Participants $participants)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Participants $participants)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParticipantsRequest $request, Participants $participants)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participants $participants)
    {
        //
    }

    public function destroyAll()
    {
        Participants::truncate(); // Menghapus seluruh data di tabel
        return redirect()->route('participant.index')->with('success', 'Semua peserta berhasil dihapus.');
    }
}
