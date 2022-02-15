<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;

class TicketController extends Controller
{
    public function index(){
        $tickets = Ticket::with(['customer','order','tickettype'])->paginate(env('PAGINATION_CODE'));
        return view('admin.tickets.tickets')->with(['tickets'=>$tickets]);
    }
}
