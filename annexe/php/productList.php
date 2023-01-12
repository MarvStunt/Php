<?php

require(__DIR__."/product.php");

$products = [];

/**
 * Initialisation de la liste des produits compris dans la BDD
 */
// 
$products[] = new product("OPT1","One Piece Tome 1",7.5);
$products[] = new product("OPT2","One Piece Tome 2",7.5);
$products[] = new product("OPT3","One Piece Tome 3",7.5);
$products[] = new product("OPT4","One Piece Tome 4",7.5);
$products[] = new product("OPT5","One Piece Tome 5",7.5);
$products[] = new product("N1","Naruto Tome 1",7.5);
$products[] = new product("N2","Naruto Tome 2",7.5);
$products[] = new product("N3","Naruto Tome 3",7.5);

