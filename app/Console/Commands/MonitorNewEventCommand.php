<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\MyLibs\Series;
use App\MyLibs\Redis;
use App\MyLibs\Events;
use App\MyLibs\MyTweet;

class MonitorNewEventCommand extends Command {
	/**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'newevent';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "We will monitor the creation of new events";
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $key = 'cache_events';

		$redis = new Redis();
		$res = Series::getEvents();
		$events = new Events( $redis->get( $key ) );
		$diff = $events->diff( new Events( $res ) );
		if( count( $diff->events ) !== 0 ) $redis->set($key, $res);
		foreach ($diff->events as $event) {
			MyTweet::newEventTweet($event);
		}
		$count = count($diff->events);
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