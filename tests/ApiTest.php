<?php

class ApiTest extends TestCase {

    public function testEmptyApiKey()
    {
        $response = $this->action("POST", "ApiController@checkTicket");

        $this->assertEquals("Ex00:Api Key Unknown", $response->getContent());
    }

    public function testWrongApiKey()
    {
        $response = $this->action("POST", "ApiController@checkTicket");

        $this->assertEquals("Ex00:Api Key Unknown", $response->getContent(), ["apikey" => "123"]);
    }

}