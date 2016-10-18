<?php

namespace Sainsburys\Tests;

use Sainsburys\AppClasses\PageScraper;

class PageScraperTest extends \PHPUnit_Framework_TestCase {

   /* 
   	 # Check the scrapper functionality
	*/
    public function testscrape_data() {
        $pageScraper = new PageScraper();

        $response= $pageScraper->scrape_data();

        $this->assertJSON($response); //check if the response is valid JSON string

        $response_detail = json_decode($response, true);
        $results = $response_detail['results'];

        $this->assertArrayHasKey('results', $response_detail);
        $this->assertArrayHasKey('total', $response_detail);
        $this->assertArrayHasKey('title', $results[0]);
        $this->assertArrayHasKey('description', $results[0]);
        $this->assertArrayHasKey('size', $results[0]);
        $this->assertArrayHasKey('unit_price', $results[0]);
    }
	
   /*
   	# check for the correct size in kb 
   */
    public function testconvertSize() {
        $size = 3000;
		$pageScraper = new PageScraper();
        
        $result = $pageScraper->convertSize($size);

        $this->assertEquals("2.93KB", $result);
    }

  }