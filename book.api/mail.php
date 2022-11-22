<?php

$to="agarwalyash272002@gmail.com";
$sub="test mail";
$msg="try try but dont cry";
$from="coinsyash@gmail.com";
$head="From: $from";

mail($to,$sub,$msg,$head);
echo "mail sent";


?>