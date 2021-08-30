<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Chapter;
use App\Models\User;

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
        $Chapters = Chapter::where( 'public', '1' )->paginate(20);

        return view('home')
            ->with( 'Chapters', $Chapters );
    }
}
