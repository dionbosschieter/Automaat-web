<?php

class HomePageTest extends TestCase {

	public function testAuthenticationRedirect()
	{
		$this->call('GET', '/');

        $this->assertRedirectedTo('login');
    }

}
