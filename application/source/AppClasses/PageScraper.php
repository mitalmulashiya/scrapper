<?php

namespace Sainsburys\AppClasses;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use Sainsburys\AppClasses\ClientService;


class PageScraper {

	private $url;
     protected $app_operation;
     protected $products_array = ['results' => [], 'total' => 0];
     
    public function __construct() {
		
        $this->app_operation = new ClientService(new Client());
    }

    /*
     # get html content from the specified url
	 # crawl the content using crawler functions
	 # find the products list from the html content body
     */
    public function scrape_data()
    {
		$this->seturl();
        $request = $this->app_operation->request($this->url);
        $crawler = new Crawler($request['body']);
		/*
			# seach for the product lists
			# iterate each products and get information
		*/
        $crawler->filter('ul.productLister .product')->each(function (Crawler $node, $i) {
			$productlink = $node->filter('h3 a');
        	$url = $productlink->attr('href');
			
			/* get the product information by passing url to function
				# will receive array of product information : size  and description
			*/ 
			$product_info = $this->productDetails($url);
			/*
				# search for the product price and get only ammount price by removing other text information 
			*/
			$product_price = preg_replace('/([^0-9\.,])/i', '', $node->filter('p.pricePerUnit')->text());
			/*
				# calculate and store grand total for product prices
			*/
			$this->products_array['total'] += $product_price;
	
			$this->products_array['results'][$i] = [
				'title' => trim($productlink->text()),
				'size' => $this->convertSize($product_info['size']),
				'unit_price' => $product_price,
				'description' => $product_info['description']
			];

        
        });

        // Format the grand total with 2 decimals
        $this->products_array['total'] = number_format($this->products_array['total'], 2);

        return json_encode($this->products_array, JSON_PRETTY_PRINT);
    }
	/* 
	# set the url to get data from
	*/
	protected function seturl($url='')
	{
		if(!empty($url))
			$this->url=$url;
		else
			$this->url="http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html";
	}
	 protected function productDetails($url)
    {
        $request = $this->app_operation->request($url);
        $crawler = new Crawler($request['body']);

        $product_detail['description'] = trim($crawler->filter('div.productText')->first()->text());
        $product_detail['size'] = $request['size'];

        return $product_detail;
    }
   
    /*
    	# converts the file size into kb
		# return formated sting with 
		  atleast 3 numbers with 2 decimal numbers and KB text
	*/
    public function convertSize($filezise_bytes) {
        return sprintf("%3.2fKB", $filezise_bytes/1024);
    }

   
}