<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 021 21.07.18
 * Time: 12:39
 */

namespace ConvertFeed\Commands;


use ConvertFeed\Factories\FeedFactory;
use ConvertFeed\Services\Converter\Converter;
use ConvertFeed\Services\Reader\ReaderService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReadCommand extends Command
{

    private $readerService;
    private $converter;

    public function __construct(ReaderService $readerService, Converter $converter)
    {
        $this->readerService = $readerService;
        $this->converter = $converter;
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
            )->addArgument('format', InputArgument::REQUIRED, 'rss, atom');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = $input->getArgument('path');
        $format = $input->getArgument('format');
        $xml = $this->readerService->process($path);
        $result = $this->converter->convert($xml, $format);

        $output->write($result);
       /// $output->writeln(print_r($feed, true));
    }
}