<?php

use App\Bak;
use App\Ticket;
use App\Trunk;

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

    public function testGetBakState()
    {
        $this->createBakAndTicket();
        $this->createTrunk();
        $response = $this->action("POST", "ApiController@getBakState", ["apikey" => 123, "nr" => 1]);

        $this->assertEquals("0x00:3", $response->getContent());
    }

    public function testGetInvalidBakState()
    {
        $this->createBakAndTicket();
        $this->createTrunk();

        $response = $this->action("POST", "ApiController@getBakState", ["apikey" => 123, "nr" => 2]);

        $this->assertStringStartsWith("Ex05", $response->getContent());
    }

    public function testSetBakState()
    {
        $this->createBakAndTicket();
        $this->createTrunk();
        $response = $this->action("POST", "ApiController@setBakState", ["apikey" => 123, "nr" => 1, "available" => 5]);

        $this->assertEquals("0x00", $response->getContent());
    }

    private function createBakAndTicket()
    {
        Bak::create(["name" => "b1", "apikey" => 123, "status" => 0]);
        Ticket::create(["ticket_number" => 123, "webcode" => 345, "bak_id" => 1, "given" => 50, "amount" => 52]);
    }

    private function createTrunk()
    {
        Trunk::create(["bill_type" => 50, "available" => 3, "bak_id" => 1, "number" => 1, "description" => "1st trunk"]);
    }

}