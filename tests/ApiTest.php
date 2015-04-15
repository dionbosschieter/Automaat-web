<?php

use App\Bak;
use App\Ticket;

class ApiTest extends TestCase {

    public function testEmptyApiKey()
    {
        $response = $this->action("POST", "ApiController@checkTicket");

        $this->assertEquals("Ex00:Api Key Unknown", $response->getContent());
    }

    public function testWrongApiKey()
    {
        $response = $this->action("POST", "ApiController@checkTicket", ["apikey" => 123]);

        $this->assertEquals("Ex00:Api Key Unknown", $response->getContent());
    }

    public function testKnownTicket()
    {
        $this->createBakAndTicket();
        $response = $this->action("POST", "ApiController@checkTicket", ["apikey" => 123, "ticketnr" => 123]);

        $this->assertEquals("Ex01:Known ticket", $response->getContent());
    }

    private function createBakAndTicket()
    {
        $b = Bak::create(["name" => "b1", "apikey" => 123, "status" => 0]);
        Ticket::create(["ticket_number" => 123, "webcode" => 345, "bak_id" => $b->id, "given" => 50, "amount" => 52]);
    }

}