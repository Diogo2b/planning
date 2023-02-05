<?php

$date_start = new DateTime($session->start);
$date_start_french = $date_start->format('d-m-Y H:i');
$date_end = new DateTime($session->end);
$date_end_french = $date_end->format('d-m-Y H:i')
?>
<h1><?= $date_start_french ?></h1>

<?php include '_form.php' ?>