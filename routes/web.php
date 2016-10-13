<?php

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

$app->get('/api', function(Request $request){

	$client = new \GuzzleHttp\Client();
	$base_url = 'http://connpass.com/api/v1/event/';
	$series_id = getenv('SERIES_ID');
	$query = array_merge([ "series_id" => $series_id ], $request->all());
	$res = $client->get($base_url,[ "query" => $query ]);
	$data = json_decode($res->getBody(),true);

	return JsonResponse::create($data,200,[]); 
});

?>