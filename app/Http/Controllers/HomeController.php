<?php

namespace App\Http\Controllers;
use App\Models\Reveal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $reveals = Reveal::whereDate('detection_date', Carbon::today())->get();
        return view('dashboard.index', compact('reveals'));
    }
}
