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

        if( ! $this->bak )
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

        $ticket->addToDatabase();
        return response("0x00:" . $ticket->getRoundedAmount());
    }

    /**
     * Used to poll for when
     *  the bak needs to close its trunks
     *
     * @return Response
     */
    public function getStatus()
    {
        return response("0x00:" . $this->bak->status);
    }

    /**
     * Used to update when a user is busy or
     *  is done and bak is idle
     *
     * @return Response
     */
    public function setStatus()
    {
        $status = Request::input("status");

        if(is_numeric($status)) {
            $this->bak->status = $status;
            $this->bak->save();
        }

        return response("0x00");
    }

    public function getTrunkState()
    {
        $trunk = $this->getTrunkOrFail();

        return response("0x00:" . $trunk->available);
    }

    public function setTrunkState()
    {
        $trunk = $this->getTrunkOrFail();
        $available = Request::input('available');

        if(is_numeric($available)) {
            $trunk->available = $available;
            $trunk->save();
        }

        return response("0x00");
    }

    private function getTrunkOrFail()
    {
        $index = Request::input('nr');
        $trunk = Trunk::ofBak($this->bak->id)->whereNumber($index)->first();

        if( ! $trunk )
            throw new ApiException("Invalid trunk", 5);

        return $trunk;
    }

}
