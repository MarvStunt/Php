<?php

class BDD {

   private /* PDO */ $pdo;

   /**
    * Get the PDO object
    *
    * @return PDO
    */
   function getPdo(): PDO
   {
      if ($this->pdo === null) {
         $this->pdo = new PDO(
            'mysql:host=localhost;dbname=id20000359_projectphp',
            'id20000359_lopes_conil',
            '}%B/YIM?4QGc(D$0'
         );
      }
      return $this->pdo;
   }
}
