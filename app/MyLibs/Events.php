<?php

namespace App\MyLibs;

class Events {
	function __construct(Array $events) {
		$this->events = $events;
	}

	/**
	* EventsとEventsの差分を取る
	*
	* @param Events $events
	* @return Events  
	*/
	public function diff(Events $events) {
		$map_eventid = function($event){
			return $event['event_id'];
		};
		
		$self_eventids = array_map($map_eventid, $this->events);
		$arg_eventids = array_map($map_eventid, $events->events);
		$eventid_diff = array_diff($arg_eventids, $self_eventids); 
		$diff= array_filter($events->events,function($event) use($eventid_diff){
			return in_array($event["event_id"],$eventid_diff);
		});

		return new Events($diff);
	}

	public function filter(callable $cb) {
		return array_filter($this->$events, $cb);
	}
}

?>