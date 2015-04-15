<?php namespace App\Http\Controllers;

use Request;
use App\Bak;
use App\Trunk;
use App\Automaat\MyTicket;
use App\Exceptions\ApiException;

class ApiController extends Controller
{
    private $bak;

    public function __construct()
    {
        $apikey = Request::input("apikey");
        $this->bak = Bak::whereApikey($apikey)->first();

        if(empty($this->bak))
            throw new ApiException("Api Key Unknown", 0);
    }

    public function checkTicket()
    {
        $ticket = new MyTicket($this->bak);
        $ticket->setTicketAndWebcode(Request::input('ticketnr'), Request::input('webcode'));

        if($ticket->ticketWasAlreadyUsed())
            throw new ApiException("Known ticket", 1);
        if($ticket->isNotValid())
            throw new ApiException("Ticket not valid", 2);
        if($ticket->isLost())
            throw new ApiException("Ticket lost", 3);
        if($this->bak->amount < $ticket->getRoundedAmount())
            throw new ApiException("Not enough money", 4);

        $this->bak->amount -= $ticket->getRoundedAmount();
        $this->bak->save();

        $ticket->addToDatabase();
        echo "0x00:" . $ticket->getRoundedAmount();
    }

    public function setStatus()
    {
        $status = Request::input("status");
        if(is_numeric($status)) {
            $this->bak->status = $status;
            $this->bak->save();
        }

        return response("0x00");
    }

    public function getBakState()
    {
        $index = Request::input('nr');
        $trunk = Trunk::ofBak($this->bak->id)->whereNumber($index)->first();

        return response("0x00:" . $trunk->available);
    }

    public function setBakState()
    {
        return response("0x00");
    }

}
