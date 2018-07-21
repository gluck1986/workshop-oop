<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 021 21.07.18
 * Time: 12:39
 */

namespace ConvertFeed\Commands;


use ConvertFeed\Factories\FeedFactory;
use ConvertFeed\Services\Reader\ReaderService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReadCommand extends Command
{

    private $readerService;
    private $feedFactory;

    public function __construct(ReaderService $readerService, FeedFactory $feedFactory)
    {
        $this->readerService = $readerService;
        $this->feedFactory = $feedFactory;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('read')
            ->setDescription('read xml file')
            ->addArgument(
                'path',
                InputArgument::REQUIRED,
                'file path'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = $input->getArgument('path');
        $xml = $this->readerService->process($path);
        $feed = $this->feedFactory->make($xml);

        $output->writeln(print_r($feed, true));
    }
}