<?php
require_once('temp/function.php');
$short_code = $_GET['short'];
$longUrl = get_data('shortlinks',$short_code,'long_url','short_code')['data'];
header("Location: $longUrl");
exit();
?>