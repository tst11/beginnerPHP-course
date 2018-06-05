<?php

$password = 'secret';

 $hash = password_hash($password, PASSWORD_DEFAULT);

// echo $hash;

$hash = '$2y$10$LOrap8PBpohoizt1sLI8CuvjRVKlat7Z7/f4PZcIQ2DnBgYtpjSwW';

var_dump(password_verify($password, $hash));