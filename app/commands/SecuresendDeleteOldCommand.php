<?php

use Illuminate\Console\Command;
use GenSend\Repositories\Interfaces\SendRepositoryInterface;
use Carbon\Carbon;

/**
 * Class SecuresendDeleteOldCommand
 */
class SecuresendDeleteOldCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'securesend:deleteold';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Deletes securesend entries that have expired.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(SendRepositoryInterface $sendRepository)
	{
		parent::__construct();
        $this->sendRepository = $sendRepository;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		//
        $this->info('Deleting records that have expired.');
        $this->info('Todays Date: ' . Carbon::now()->toFormattedDateString());
        $numberOfRecordsDeleted = $this->sendRepository->deleteOutOfDateRecords();
        $this->info($numberOfRecordsDeleted . ' records deleted. ');
        return 0;
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			//array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			//array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
