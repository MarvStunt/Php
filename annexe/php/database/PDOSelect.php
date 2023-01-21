<?php

require_once(__DIR__ . "/BDD.php");

$pdo = new BDD();

/**
 * Get the PDO object
 *
 * @return PDO
 */
function getPDO(): PDO
{
    return $GLOBALS["pdo"]->getPDO();
}
