<?php

require_once(__DIR__ . "/BDD.php");

$pdo = new BDD();

function getPDO(): PDO
{
    return $GLOBALS["pdo"]->getPDO();
}
