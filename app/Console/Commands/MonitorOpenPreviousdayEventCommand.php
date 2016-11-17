<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\MyLibs\Series;
use App\MyLibs\Events;
use App\MyLibs\MyTweet;

class MonitorOpenPreviousdayEventCommand extends Command {
	/**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'previose';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "We announce the event the day before the event";
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
       	$res = Series::getOpenPreviousday();
		foreach ($res as $event) {
			try {
				Mytweet::openPreviousdayEventTweet($event);
			} catch (\Exception $e) {
			}
		}
		$count = count($res);
		echo "{$count}tweet";
    }
    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
        );
    }
}

?>