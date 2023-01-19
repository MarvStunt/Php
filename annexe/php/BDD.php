<?php
class BDD
{
   // Variable global PDO
   private $pdo;

   function __construct()
   {
      $this->pdo = new PDO(
         'mysql:host=localhost;dbname=id20000359_projectphp',
         'id20000359_lopes_conil',
         '#0&?HBy{RTN7CJV5'
      );
   }

   /**
    * Check if data base linked
    *
    * @return bool
    */
   function checkLink(): bool
   {
      return $GLOBALS["pdo"] ? true : false;
   }


   /**
    * Get PDO
    *
    * @return PDO
    */
   static function getPdo(){
      return $GLOBALS["pdo"];
   }
}
