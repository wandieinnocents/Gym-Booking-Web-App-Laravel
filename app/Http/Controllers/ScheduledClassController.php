<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassType;
use App\Models\ScheduledClass;
use App\Events\ClassCanceled;
use App\Models\User;

class ScheduledClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $scheduled_classes = auth()->user()->scheduled_classes()->where('date_time', '>', now())->oldest('date_time')->get();
        $data = [
            'scheduled_classes' => $scheduled_classes,
        ];
        return view('instructor.upcoming', $data );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $class_types = ClassType::all();
        return view('instructor.schedule',compact('class_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $date_time = $request->input('date') . " " . $request->input('time');
        $request->merge(
            [
                'date_time' => $date_time,
                'instructor_id' => auth()->id(),
            ]
        );
        
        // Check if the date_time already exists
        $existingClass = ScheduledClass::where('date_time', $date_time)->first();
        
        if ($existingClass) {
            return back()->withErrors(['date_time' => 'This date and time slot is already taken. Please choose another time.']);
        }
        
        // Validate and create if date_time is unique
        $validated = $request->validate([
            'class_type_id' => 'required',
            'instructor_id' => 'required',
            'date_time' => 'required|unique:scheduled_classes,date_time|after:now',
        ]);
        
        ScheduledClass::create($validated);
        return redirect()->route('schedule.index');
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScheduledClass $schedule)
    {
       
        if(auth()->user()->cannot('delete',$schedule)){
            abort(403);
        }

        //listener when class booking is canceled
        ClassCanceled::dispatch($schedule);

        // $schedule->delete();
        // $schedule->members->detach();
        return redirect()->route('schedule.index');

    }
}
