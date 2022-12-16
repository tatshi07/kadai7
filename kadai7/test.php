<?php
	$url = file_get_contents('https://job.yahooapis.jp/v1/furusato/company/?appid=dj00aiZpPUdMNnViOXI0OFc4RSZzPWNvbnN1bWVyc2VjcmV0Jng9NDg-');
	$response = json_decode($url, true);
	$title = $response['results'][1]['title'];
	print $title;
?>