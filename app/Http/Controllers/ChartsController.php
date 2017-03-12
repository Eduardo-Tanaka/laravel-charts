<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ChartsController extends Controller
{
    public function line()
    {
   		return view('charts.line');
    }

    public function linejson()
    {
    	$json = '[
	    	{ "date": "24-Apr-07", "close": "93.24" },
	    	{ "date": "25-Apr-07", "close": "95.35" },
	    	{ "date": "26-Apr-07", "close": "98.84" }
	    ]';
   		return $json;
    }
}
   

