<?php

setcookie('example', '', time() - 3600);

echo 'Cookie deleted.';