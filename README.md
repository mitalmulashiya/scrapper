# Sainsbury's Coding Test for Software Engineering - coded by Mital #

A console application that shows ability to consume a webpage; scrapes the Sainsbury’s grocery site - Ripe Fruits page and returns a JSON array of all the products on the page.

#### Requirements ####

* PHP >= v5.6 
* Composer - [https://getcomposer.org/download/]


#### Application Setup ####

1. Unzip the file
2. Copy the project on the testing enviornment/server.
3. Go to application root directory in your terminal.
4. Run `composer install`


#### Command to Run Application ####

1. Run `php scrape get-fruits` to scrape all the fruits products from the Sainsbury’s grocery site - Ripe Fruits page.


####  Testings ####

1. Run `vendor/bin/phpunit application/tests/`  
[on windows platform enclose command in double quotes: "vendor/bin/phpunit" application/tests/]


#### Dependencies composer going to install ####

1. symfony/console - [https://packagist.org/packages/symfony/console] - 3.1
	=> The Console component eases the creation of beautiful and testable command line interfaces

2. guzzlehttp/guzzle - [https://packagist.org/packages/guzzlehttp/guzzle] - 6.2
	=> Guzzle is a PHP HTTP client that makes it easy to send HTTP requests and trivial to integrate with web services.
	=> Simple interface for building query strings, POST requests, streaming large uploads, streaming large downloads, using HTTP cookies, uploading JSON data, etc...
    => Can send both synchronous and asynchronous requests using the same interface.
    => Uses PSR-7 interfaces for requests, responses, and streams. This allows you to utilize other PSR-7 compatible libraries with Guzzle.
    
3. symfony/css-selector - [https://packagist.org/packages/symfony/css-selector] - 3.1
	=> The CssSelector component converts CSS selectors to XPath expressions.

4. symfony/dom-crawler - [https://packagist.org/packages/symfony/dom-crawler] - 3.1
	=> The DomCrawler component eases DOM navigation for HTML and XML documents.

5. phpunit/phpunit -  [https://packagist.org/packages/phpunit/phpunit] - 5.6
	=> PHPUnit is a programmer-oriented testing framework for PHP. It is an instance of the xUnit architecture for unit testing frameworks.

6.	mockery/mockery - [https://packagist.org/packages/mockery/mockery] - 0.9.5
	=> Mockery is a simple yet flexible PHP mock object framework for use in unit testing with PHPUnit, PHPSpec or any other testing framework. Its core goal is to offer a test double framework with a succinct API capable of clearly defining all possible object operations and interactions using a human readable Domain Specific Language (DSL). Designed as a drop in alternative to PHPUnit's phpunit-mock-objects library, Mockery is easy to integrate with PHPUnit and can operate alongside phpunit-mock-objects without the World ending.
