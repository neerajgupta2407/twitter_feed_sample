<?php
$start = $_GET['start'];
$limit = $_GET['limit'];

$res = array();
for($i = $start;$i < ($limit+$start); $i++)
{
	$res[] = 'Tweet count is .'.$i;
}

echo json_encode(array('status' => true,'data' => $res));