<?php
/// https://www.php.net/manual/en/book.sockets.php

$port = 5555;
set_time_limit(0);
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("socket_create failed");
socket_bind($socket, '0.0.0.0', $port) or die("socket_bind failed");
socket_listen($socket);

try {
    while (true) {
        if (($newc = socket_accept($socket)) !== false) {

            //Get buffer of message
            $buffer = socket_read($newc, 1024) or die("Could not read input\n");
            //Get message
            $input = socket_read($newc, $buffer) or die("Could not read input\n");
            $data = json_decode($input)->data;
            //Send data back
            socket_write($newc, $data, strlen($data)) or die("Could not write output\n");

            socket_close($newc);
        }
    }
} catch (Exception $e) {
    echo 'Caught exception: ' . $e;
} finally {
    socket_close($socket);
}
