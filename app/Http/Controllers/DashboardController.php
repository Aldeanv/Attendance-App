<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Attendance;
use App\Models\Participants;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Attendance = Attendance::latest()->limit(3)->get();
        $totalParticipants = Participants::count();
        $totalAttendance = Attendance::count();
        $notAttended = $totalParticipants - $totalAttendance;
        $eventname = Event::orderBy('date', 'desc')->get();
        return view('dashboard', compact(
            'eventname', 
            'totalParticipants', 
            'totalAttendance', 
            'notAttended',
            'Attendance'
        ));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
