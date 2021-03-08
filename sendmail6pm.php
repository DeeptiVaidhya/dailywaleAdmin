<?php
$date_time = date("H:i:s");
//print_r($date_time);
if($date_time == '18:00:00'){

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://dailywale.com/dailywaleAdmin/index.php/SendOrderMail/downloadDailyOrdersCSV_next_day");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);
curl_close ($ch);



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://dailywale.com/dailywaleAdmin/index.php/SendOrderMail/downloadOrdersSummaryCSV_next_day");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);
curl_close ($ch);






$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://dailywale.com/dailywaleAdmin/index.php/SendOrderMail/sendDailyOrderMail_next_day");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);
curl_close ($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://dailywale.com/dailywaleAdmin/index.php/SendOrderMail/sendOrderSummaryMail_next_day");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);
curl_close ($ch);

}

?>
