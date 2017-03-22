<?php
$fp = fsockopen('202.150.213.10', 587, $errno, $errstr, 5);
if (!$fp) {
    // port is closed or blocked
echo "ora kebukak";
} else {
    // port is open and available
echo "kebukak";
    fclose($fp);
}
?>