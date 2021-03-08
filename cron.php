<?php


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://dailywale.com/dailywaleAdmin/index.php/Orders/downloadDailyOrdersCSV");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);
curl_close ($ch);



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://dailywale.com/dailywaleAdmin/index.php/Orders/downloadOrdersSummaryCSV");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);
curl_close ($ch);






/*$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://dailywale.com/dailywaleAdmin/index.php/Orders/sendDailyOrderMail");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);
curl_close ($ch);*/

/*$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://dailywale.com/dailywaleAdmin/index.php/Orders/sendOrderSummaryMail");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);
curl_close ($ch);
*/

?>
