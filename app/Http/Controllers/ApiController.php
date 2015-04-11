<?php namespace App\Http\Controllers;

use App\Automaat\MyTicket;
use App\Bak;
use Request;

class ApiController extends Controller
{
    private $bak;

    public function __construct()
    {
        $apikey = Request::input('apikey');
        $this->bak = Bak::whereApikey($apikey)->first();

        if(empty($this->bak))
            die("Ex00:Api Key Unknown");
    }

    public function checkTicket()
    {
        $ticket = new MyTicket($this->bak);
        $ticket->setTicketAndWebcode();

        if($ticket->ticketWasAlreadyUsed()) die("Ex01:Ticket already used");
        if($ticket->isNotValid()) die("Ex02:Ticket not valid");
        if($ticket->isLost()) die("Ex03:Ticket lost");
        if($this->bak->amount < $ticket->getRoundedAmount()) die("Ex04:Not enough money");

        $this->bak->amount -= $ticket->getRoundedAmount();
        $ticket->addToDatabase();
        echo "0x00:" . $ticket->getRoundedAmount();
    }

    public function setStatus()
    {
        $status = Request::input('status');
        if(is_numeric($status)) {
            $this->bak->status = $status;
            $this->bak->save();
        }

        echo "0x00";
    }

}
