<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MainFunctionalTest extends WebTestCase
{
	/** @dataProvider provideUrls */
	public function testPageIsSuccessful($url)
	{
 	   $client = self::createClient();
 	   $client->request('GET', $url);

 	   $this->assertTrue($client->getResponse()->isSuccessful());
	}

	public function provideUrls()
	{
 	   return array(
  	     array('/'),
   	     array('/login'),
   	     array('/register')
   	 	);
	}
}
