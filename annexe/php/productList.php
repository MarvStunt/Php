<?php

require(__DIR__."/product.php");

$products = [];

/**
 * Initialisation de la liste des produits compris dans la BDD
 */
// 
$products[] = new product("OPT1","One PIece Tome 1",7.5);
$products[] = new product("OPT2","One PIece Tome 2",7.5);
$products[] = new product("OPT3","One PIece Tome 3",7.5);
$products[] = new product("N1","Naruto Tome 1",7.5);
$products[] = new product("N2","Naruto Tome 2",7.5);
$products[] = new product("N3","Naruto Tome 3",7.5);

