<?php

namespace App\MyLibs;
use App\MyLibs\Utils;
use App\MyLibs\Events;
use Carbon\Carbon;


class API {
	public static function getEvents() {
		$client = new \GuzzleHttp\Client();
		$base_url = 'http://connpass.com/api/v1/event/';
		$series_id = env('SERIES_ID');
		$now = Carbon::now();
		$res = $client->get($base_url,[
			"query" => [ 
				"series_id" => $series_id,
				"count" => 10,
				"ym" => $now->format('Ym') . ','. $now->addMonths(1)->format('Ym'). ','. $now->addMonths(2)->format('Ym')
			]
		]);
		$data = json_decode($res->getBody(),true);
		return $data["events"];
	}
}

?>