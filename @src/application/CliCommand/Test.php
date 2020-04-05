<?php namespace Application\CliCommand;

use Andesite\Core\Boot\Andesite;
use Andesite\Mission\Cli\CliModule;
use Application\Ghost\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class Test extends CliModule{

	protected function createCommand($config): Command{
		return new class( 'test' ) extends Command{
			protected function configure(){}
			protected function execute(InputInterface $input, OutputInterface $output){
				$style = new SymfonyStyle($input, $output);
				$style->warning('HELLO');
			}
		};
	}

}