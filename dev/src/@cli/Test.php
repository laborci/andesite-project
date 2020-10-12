<?php namespace Application\Cli;

use Andesite\Mission\Cli\Command\Cmd;
use Andesite\Mission\Cli\Command\CommandModule;


/**
 * @command-group app
 */
class Test extends CommandModule{

	/**
	 * @alias       test
	 */
	public function test(): Cmd{
		return ( new class extends Cmd{
			public function __invoke(){
				$this->style->success('DONE');
			}
		} );
	}
}
