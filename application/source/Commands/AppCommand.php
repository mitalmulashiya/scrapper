<?php

namespace Sainsburys\Commands;

use Sainsburys\AppClasses\PageScraper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class AppCommand extends Command
{
    private $scraper;

    public function __construct() {
        $this->scraper = new PageScraper();
        parent::__construct();
    }
     /*
		 # Command Configuration Code
		 # The command get-fruits will be used to run application
		 # The parent class Command's method : configure must be overwide here with settings
     */
    protected function configure()
    {
        $this->setName('get-fruits')
             ->setDescription('An application to scrapes the Sainsburys page');
    }

    /*
		 # using InputInterface and OutputInterface for console input/output operation
		 # The parent class Command's method : execute must be override here to run the app
     */
    protected function execute(InputInterface $take, OutputInterface $display)
    {
        $display->writeln('Processing, Please Wait...');
        $display->writeln($this->scraper->scrape_data());
    }

}