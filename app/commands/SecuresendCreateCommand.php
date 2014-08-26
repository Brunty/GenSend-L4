<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use GenSend\Repositories\Interfaces\SendRepositoryInterface;
use Carbon\Carbon;

/**
 * Class SecuresendCreateCommand
 */
class SecuresendCreateCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'securesend:create';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create an entry for a password from the command line.';

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
        $securesend = $this->sendRepository->create(array(
            'views'         =>  $this->option('views'),
            'days'          =>  $this->option('days'),
            'password'      =>  $this->option('password')
        ));

        if($securesend === false) {
            echo $this->error('There was a problem storing your password for sending.');
            return 1; // command failed return 1 (or anything that isn't 0)
        }
        else
        {

            echo $this->comment('Entry created!');

            $expiryDate = Carbon::now()->addDays($this->option('days'));

            echo $this->info('It will expire after: ' . $this->option('views') . ' views.');
            echo $this->info('It will expire on: ' . $expiryDate->toFormattedDateString());
            echo $this->info('URL is below:');
            echo $this->comment('------------------------------------');
            echo $this->info(' ');
            echo $this->info(URL::to('/v/' . $securesend->url));
            echo $this->info(' ');
            echo $this->comment('------------------------------------');
            return 0; // return 0 command successful
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
			//array('password', InputArgument::REQUIRED, 'The password you\'ll be sending.'),
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
			array('password', null, InputOption::VALUE_REQUIRED, 'The password you\'ll be sending.', null),
            array('views', null, InputOption::VALUE_OPTIONAL, 'The number of views before this password expires.', 3),
            array('days', null, InputOption::VALUE_OPTIONAL, 'The number of days before this password expires.', 7),
		);
	}

}
