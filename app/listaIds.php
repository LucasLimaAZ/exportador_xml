<?php

require_once 'funcoes.php';

$ids = scandir("../output");
die(json_encode($ids));