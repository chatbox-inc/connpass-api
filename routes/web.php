<?php

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

$app->get('/', function(){
	return 'hello!';
});

$app->get('/api', function(Request $request){

	$client = new \GuzzleHttp\Client();
	$base_url = 'http://connpass.com/api/v1/event/';
	$series_id = getenv('SERIES_ID');
	$query = array_merge([ "series_id" => $series_id ], $request->all());
	$res = $client->get($base_url,[ "query" => $query ]);
	$data = json_decode($res->getBody(),true);

	return JsonResponse::create($data,200,[]); 
});

use App\MyLibs\API;
use App\MyLibs\Redis;
use App\MyLibs\Events;

$app->get('/test/new',function(){
	$key = 'cache_events';

	$client = new Redis();
	$res = API::getEvents();
	$events = new Events( $client->get( $key ) );
	$diff = $events->diff( new Events( $res ) );
	if( count( $diff ) !== 0 ) $client->set($key, $res);
	return JsonResponse::create($diff);
});

$app->get('/tweet', function() use($app)
{	
	$tweet = Twitter::getUserTimeline(['screen_name' => 'HatchUp', 'count' => 1, 'format' => 'json']);
    $hoge = Twitter::postTweet(['status' => 'testtesttesttesttesttesttesttesttesttest http://44-test.connpass.com/event/43275/ #hogehoge', 'format' => 'json'] );
	return JsonResponse::create($hoge);
});
?>