<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;

use Carbon\Carbon;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$now = Carbon::now();	
    	$tom = Carbon::now()->addDay(1);	
    	$today = Event::whereDate('from','>=',$now)->whereDate('from','<=',$tom)->get();
    	$upcoming = Event::whereDate('from','>',$tom)->get();
    	$previous = Event::whereDate('to','<',$now)->get();
    	$events = Event::all();
    	$data  = compact('today','upcoming','previous','events');

    	return response()->json($data, 200);

    }

    public function store(Request $request)
    {
    	$event = $request->all();
    	if($event['to'] == null || $event['to'] == ''){
    		$event['to'] = $event['from'];
    	}
    	$newEvent = auth()->user()->events()->create($event);

    	return response()->json($newEvent, 201);
    }
}
