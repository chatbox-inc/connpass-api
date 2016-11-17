<?php 

namespace App\MyLibs;

use Twitter;

class MyTweet 
{
	public static function newEventTweet($event) {
		$status = "{$event['title']}が公開されました。　{$event['event_url']}";
		if( $event['hash_tag'] !== '' ) $status .= " #{$event['hash_tag']}";
		if( env('SERIES_HASH_TAG', '') !== '' ) {
			$seriesHashTag = env('SERIES_HASH_TAG', '');
			$status .= " #{$seriesHashTag}";
		}
		return Twitter::postTweet(['status' => $status, 'format' => 'json'] );
	}

	public static function openPreviousdayEventTweet($event) {
		$status = "{$event['title']}は明日開催です。 {$event['event_url']}";
		if( $event['hash_tag'] !== '' ) $status .= " #{$event['hash_tag']}";
		if( env('SERIES_HASH_TAG', '') !== '' ) {
			$seriesHashTag = env('SERIES_HASH_TAG', '');
			$status .= " #{$seriesHashTag}";
		}
		return Twitter::postTweet(['status' => $status, 'format' => 'json'] );
	}
}