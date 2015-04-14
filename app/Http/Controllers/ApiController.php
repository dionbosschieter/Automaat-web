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
    }

    public function checkTicket()
    {
        if(empty($this->bak)) return "Ex00:Api Key Unknown";
        $ticket = new MyTicket($this->bak);
        $ticket->setTicketAndWebcode();

        if($ticket->ticketWasAlreadyUsed()) return "Ex01:Known ticket";
        if($ticket->isNotValid()) return "Ex02:Ticket not valid";
        if($ticket->isLost()) return "Ex03:Ticket lost";
        if($this->bak->amount < $ticket->getRoundedAmount()) return "Ex04:Not enough money";

        $this->bak->amount -= $ticket->getRoundedAmount();
        $this->bak->save();

        $ticket->addToDatabase();
        echo "0x00:" . $ticket->getRoundedAmount();
    }

    public function setStatus()
    {
        if(empty($this->bak)) return "Ex00:Api Key Unknown";

        $status = Request::input('status');
        if(is_numeric($status)) {
            $this->bak->status = $status;
            $this->bak->save();
        }

        return "0x00";
    }

}
