<?php

namespace App\Http\Controllers;

use App\Models\CarouselOne;
use App\Models\CarouselTwo;
use App\Models\countries;
use App\Models\DocumentType;
use App\Models\FoundDocuments;
use App\Models\lostDocuments;
use App\Models\visits;
use App\Models\Partners;

class HomeController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function welcome()
    {
        session_start();
        if (!isset($_SESSION['visited'])) {
            $_SESSION['visited'] = 1;
            $visit = new visits(['status' => true]);
            $visit->save();
        }
        return view('welcome')->with([
            'advertOnes' => CarouselOne::all(),
            'advertTwos' => CarouselTwo::all(),
            'visits' => visits::all(),
            'countries' => countries::orderBy('name', 'ASC')->get(),
            'types' => DocumentType::orderBy('name', 'ASC')->get(),
            'lostDocuments' => lostDocuments::all(),
            'foundDocuments' => FoundDocuments::all(),
            'partners' => Partners::where('status', true)->get(),
        ]);
    }
}
