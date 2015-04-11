<?php namespace App\Automaat;

use Request;
use App\Ticket;
use App\Bak;
use Sunra\PhpSimple\HtmlDomParser;
use GuzzleHttp;

class MyTicket
{
    const URL = "http://myticket.cc/";

    private $request;
    private $client;
    private $webcode;
    private $ticketnr;
    private $bak;
    private $amount = false;
    private $body = false;

    public function __construct(Bak $bak)
    {
        $this->bak = $bak;
        $this->client = new GuzzleHttp\Client();
        $this->request = $this->client->createRequest('POST', MyTicket::URL);
    }

    public function setTicketAndWebcode()
    {
        $ticketnr = Request::input('ticketnr');
        $webcode = Request::input('webcode');

        $this->setTicketnr($ticketnr);
        $this->setWebcode($webcode);
    }

    private function setTicketnr($ticketnr)
    {
        $this->ticketnr = $ticketnr;
        $query = $this->request->getQuery();
        $query->set('tn', $ticketnr);
    }

    private function setWebcode($webcode)
    {
        $this->webcode = $webcode;
        $query = $this->request->getQuery();
        $query->set('wc', $webcode);
    }

    private function doRequest()
    {
        if( ! $this->body ) {
            $response = $this->client->send($this->request);
            $this->body = $response->getBody();
        }

        return $this->body;
    }

    public function isValid()
    {
        $this->dom = HtmlDomParser::str_get_html($this->doRequest());
        $elems = $this->dom->find('table.ticketStatusTable');

        return count($elems) > 0;
    }

    public function isNotValid()
    {
        return ! $this->isValid();
    }

    public function isLost()
    {
        $this->dom = HtmlDomParser::str_get_html($this->doRequest());
        $elems = $this->dom->find('td.statusHighlight');

        return strpos($elems[0]->plaintext, "Lost") !== false;
    }

    private function getTicketHeader()
    {
        $header = $this->dom->find('#ticketHeader');
        if (count($header) > 0) return $header[0];
    }

    public function getAmount()
    {
        if(! $this->amount) {
            $header = $this->getTicketHeader();
            $table = $header->last_child();

            foreach ($table->children() as $e) {

                if (trim($e->plaintext) == 'Paid-out amount')
                    $this->amount = $e->next_sibling()->plaintext;
            }
        }

        return $this->amount;
    }

    public function getRoundedAmount()
    {
        $amount = $this->getAmount();

        return round($amount / 5) * 5;
    }

    public function ticketWasAlreadyUsed()
    {
        return Ticket::whereTicketNumber($this->ticketnr)->count() > 0;
    }

    public function addToDatabase()
    {
        $ticket = new Ticket;

        $ticket->bak_id = $this->bak->id;
        $ticket->ticket_number = $this->ticketnr;
        $ticket->webcode = $this->webcode;
        $ticket->amount = $this->getAmount();
        $ticket->given = $this->getRoundedAmount();

        $ticket->save();
    }

    public function getResponse()
    {
        $amount = $this->getRoundedAmount();

        return "0x00:$amount";
    }

}