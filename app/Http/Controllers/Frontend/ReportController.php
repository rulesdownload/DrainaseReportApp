<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ReportController extends Controller
{
    public function render() {

    	return view('frontend.laporan.create');	
    }
    

    public function view() {

    	return view('frontend.laporan.show');
    }
}
