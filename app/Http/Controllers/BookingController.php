<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScheduledClass;

class BookingController extends Controller
{

    public function index(){
        $bookings = auth()->user()->bookings()->upcoming()->get();

       
        return view('member.upcoming', compact('bookings'));

    }

    public function create(){

        //remove classes which are booked
        $scheduled_classes = ScheduledClass::upcoming()
        ->with('class_type','instructor')
        ->notBooked()
        ->oldest('date_time')
        ->get();
        return view('member.book',compact('scheduled_classes'));
    }

    public function store(Request $request){
        //attach relationship
        auth()->user()->bookings()->attach($request->scheduled_class_id);
        return redirect()->route('booking.index');
    }

    public function destroy(int $id){
        // dd("canceling class");

        auth()->user()->bookings()->detach($id);
       
        return redirect()->route('booking.index');

    }
}
