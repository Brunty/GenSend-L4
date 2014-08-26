<?php

use Illuminate\Console\Command;
use GenSend\Repositories\Interfaces\SendRepositoryInterface;
use Carbon\Carbon;

/**
 * Class SecuresendClearEverythingCommand
 */
class SecuresendClearEverythingCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'securesend:cleareverything';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Clears out the securesends table of the database. CAUTION: USE AT YOUR OWN RISK.';

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
		if ($this->confirm('Are you sure you want to do this? [yes|no]'))
        {
            $this->info('Deleting all securesend records. You better know what you\'re doing.');
            $numberOfRecordsDeleted = $this->sendRepository->deleteAllSecureSends();
            $this->info($numberOfRecordsDeleted . ' records deleted. ');
            return 0;
        }
        else
        {
            $this->info('Ending command, not deleting anything.');
        }
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
