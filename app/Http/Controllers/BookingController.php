<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScheduledClass;

class BookingController extends Controller
{

    public function index(){
        $bookings = auth()->user()->bookings()->where('date_time','>',now())->get();
        return view('member.upcoming', compact('bookings'));

    }

    public function create(){
        $scheduled_classes = ScheduledClass::where('date_time','>',now())
        ->with('class_type','instructor')
        ->oldest()
        ->get();
        // return($scheduled_classes);
        return view('member.book',compact('scheduled_classes'));
    }

    public function store(Request $request){
        // dd($request->all());
        //attach relationship
        auth()->user()->bookings()->attach($request->scheduled_class_id);
        return redirect()->route('booking.index');
    }

    public function destroy(int $id){
        auth()->user()->bookings()->detach($id);
        return redirect()->route('booking.index');

    }
}
