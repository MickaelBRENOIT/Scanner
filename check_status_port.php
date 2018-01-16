<?php 
    error_reporting(0);
    $ip = $_POST["ip"];
    $port = $_POST["port"];
    $type = $_POST["type"];

    /* check if variables were not changed in the pipeline transmission */
    if(isset($ip) && isset($port) && !empty($ip) && !empty($port) && is_numeric($port) && $port > 0 && $port <= 65535 && filter_var($ip, FILTER_VALIDATE_IP,FILTER_FLAG_IPV4)) {

        if($type === "TCP"){

            $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        
            socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 1, 'usec' => 0));
            
            socket_connect($socket, $ip, $port);
            $socket_code = socket_last_error($socket);
            $socket_mess = utf8_encode(socket_strerror($socket_code));
            //$socket_mess = mb_convert_encoding(socket_strerror($socket_code), "HTML-ENTITIES", 'UTF-8');
            $socket_port = $port;
            socket_close($socket);
            
            echo "$socket_code&$socket_mess&$socket_port";
            exit();

        } else if($type === "UDP") {

            $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
            socket_bind($socket, $ip, $port);        
            socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 1, 'usec' => 0));

            $from = '';
            socket_recvfrom($socket, $buf, 12, 0, $from, $port);

            $socket_code = socket_last_error($socket);
            $socket_mess = utf8_encode(socket_strerror($socket_code));

            $socket_port = $port;

            socket_close($socket);

            echo "$socket_code&$socket_mess&$socket_port";
            exit();

        }

    }
?>