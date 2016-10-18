<?php

namespace Sainsburys\AppClasses;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use Symfony\Component\Yaml\Exception\RuntimeException;

class ClientService {

    // #to store generated responce array */
    protected $response;
    // # object of GuzzleHttp\Client  */
    protected $requestobj;

    public function __construct(Client $GuzzleClient)
	{
        $this->requestobj = $GuzzleClient;
    }

    /*
     	# check the given url for validity
	 	# request for the html data and return the responce
     */
    public function request($url)
    {
		 if (!$this->CheckUrl($url)) {
            throw new RuntimeException(sprintf('URL not valid: %s', $url));
        }
        try {
            $response = $this->requestobj->request('GET', $url);
        } catch (ConnectException $e) {
            throw new RuntimeException('Unable to connect to the url');
        }
		$this->response['body'] = $response->getBody()->getContents();
        $this->response['size'] = $response->getBody()->getSize();
		return $this->response;	
       
    }
	
	/*
		# function to check gien url is valid or not
	*/
	public function CheckUrl($url)
	{
		 if (filter_var($url, FILTER_VALIDATE_URL) === false)
		 	return false;
        return true;
	}
}