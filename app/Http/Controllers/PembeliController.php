<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembeliController extends Controller
{
    public function viewIndex()
    {
        return view('pembeli.index');
    }
    public function viewReservation()
    {
        return view('pembeli.reservation');
    }
    public function viewRoom()
    {
        return view('pembeli.room');
    }
}
