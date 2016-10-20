<?php

namespace App\MyLibs;

class Events {
	function __construct(Array $events) {
		$this->events = $events;
	}

	public function diff(Array $events) {
		$map_eventid = function($event){
			
			return $event['event_id'];
		};
		
		$self_eventids = array_map($map_eventid, $this->events);
		$arg_eventids = array_map($map_eventid, $events);
		$eventid_diff = array_diff($arg_eventids, $self_eventids); 
		$diff= array_filter($events,function($event) use($eventid_diff){
			return in_array($event["event_id"],$eventid_diff);
		});

		return $diff;
	} 
}

?>