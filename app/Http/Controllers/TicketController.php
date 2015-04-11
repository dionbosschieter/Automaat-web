<?php namespace App\Http\Controllers;

use App\Ticket;

class TicketController extends Controller {

    public function index()
    {
        $tickets = Ticket::with('bak')->get();

        return view('tickets', compact('tickets'));
    }

}