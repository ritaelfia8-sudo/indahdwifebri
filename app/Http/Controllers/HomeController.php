<?php

namespace App\Http\Controllers;

use App\Models\Course;

class HomeController extends Controller
{
    public function index()
    {
        $siteName = 'KursusKu';

        $featured = Course::where('status', 'open')
            ->orderBy('start_date')
            ->take(3)
            ->get();

        return view('home', compact('siteName', 'featured'));
    }
}