<?php

$sensorfile = '/home/pi/pi-heating-hub/config/sensors';

$sensors = file( $sensorfile, FILE_SKIP_EMPTY_LINES );

$count = count( $sensors );

print_r ( $count );

?>
