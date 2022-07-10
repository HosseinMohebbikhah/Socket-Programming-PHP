<?php
/// https://www.php.net/manual/en/book.sockets.php

$host    = "127.0.0.1";
$port    = 5550;
$data = json_encode(['data' => 'https://www.php.net/']);
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
try {
    if ((socket_connect($socket, $host, $port)) !== false) {

        //Send buffer of message for initiolize
        socket_write($socket, strlen($data), strlen(strlen($data))) or die("Could not send buffer of data to server\n");
        //Send message
        socket_write($socket, $data, strlen($data)) or die("Could not send data to server\n");
        $result = socket_read($socket, 1024) or die("Could not read server response\n");

        echo "Reply From Server: " . $result;
    }
} catch (Exception $e) {
    echo 'Caught exception: ' . $e;
} finally {
    socket_close($socket);
}
