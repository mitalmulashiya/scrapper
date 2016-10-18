<?php
namespace Sainsburys\Tests;

use Mockery;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Sainsburys\AppClasses\ClientService;

class ClientServiceTest extends \PHPUnit_Framework_TestCase {

    const URL = 'http://www.faketesturl.com';

    /*
     	# mock the response
		# check the request functionality
     */
    public function testRequest() {
		$clientMock = Mockery::mock(Client::class);
		/*
			# generate the response options parameter array,
			# can set : response code value, header contents, body etc, based on requirements
		*/
		$responseoptions = [
            'body' => '<html><body><b>testing some body data</b></body></html>'
        ];
        $response = new Response('', [], $responseoptions['body']); //status code , header, body

        $clientMock
             ->shouldReceive('request')
             ->once()
             ->andReturn($response);
		
		$clientService = new ClientService($clientMock);
		
		$this->assertTrue($clientService->CheckUrl(self::URL));
		$request = $clientService->request(self::URL);
		$this->assertTrue(is_array($request));
		$this->assertArrayHasKey('body', $request);
		$this->assertArrayHasKey('size', $request);
		$this->assertEquals($responseoptions['body'], $request['body']);
	}
}