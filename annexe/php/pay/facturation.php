<?php
require_once dirname(__DIR__) . "/global.php";
class facturation
{
   private $id_panier;
   private $date_creation;
   private $nom_acheteur;
   private $prenom_acheteur;
   private $mail_acheteur;
   private $listeProduits;
   private $prixTotalHT;
   private $prixTotalTTC;
   private $panierQuantite;
   private $pdo;

   public function __construct($id_panier, $date_creation, $nom_acheteur, $prenom_acheteur, $mail_acheteur, $listeProduits, $prixTotalTTC)
   {
      $this->id_panier = $id_panier;
      $this->date_creation = $date_creation;
      $this->nom_acheteur = $nom_acheteur;
      $this->prenom_acheteur = $prenom_acheteur;
      $this->mail_acheteur = $mail_acheteur;
      $this->listeProduits = $listeProduits;
      $this->prixTotalTTC = $prixTotalTTC;

      // On arrondis à deux chiffres après la virgule
      $this->prixTotalHT = round($prixTotalTTC / 1.2, 2);

      // On créer un tableau avec les id des produits en clé et la quantité en valeur
      $this->panierQuantite = [];
      foreach ($this->listeProduits as $key => $value) {
         if (array_key_exists($value["id_produit"], $this->panierQuantite)) {
            $this->panierQuantite[$value["id_produit"]] += 1;
         } else {
            $this->panierQuantite[$value["id_produit"]] = 1;
         }
      }

      // Création du PDO pour la BDD
      $this->pdo = new PDO(
         'mysql:host=localhost;dbname=id20000359_projectphp',
         'id20000359_lopes_conil',
         '}%B/YIM?4QGc(D$0'
      );
   }

   /**
    * Fonction qui envois un mail au client
    *
    * Cela ne marche pas, car notre hébergeur n'accepte pas l'envois de mail et n'a pas de server pour envoyer des mails
    * @return void
    */
   public function sendMailClient()
   {
      $to = $this->mail_acheteur;
      $subject = "Facture de votre commande";
      $message = "Bonjour " . $this->prenom_acheteur . " " . $this->nom_acheteur . ",\n\n";
      $message .= "Voici la facture de votre commande du " . $this->date_creation . ":\n\n";
      $message .= "Produits achetés:\n";
      // On créer le message avec la liste des produits avec leur quantite et leur prix
      foreach ($this->listeProduits as $key => $value) {
         $message .= $value["titreProduit"] . " x" . $this->panierQuantite[$value["id_produit"]] . " : " . $value["prixPublic"] * $this->panierQuantite[$value["id_produit"]] . "€\n";
      }
      $message .= "\n";
      $message .= "Prix total HT: " . $this->prixTotalHT . "€\n";
      $message .= "Prix total TTC: " . $this->prixTotalTTC . "€\n";
      $message .= "\n";
      $message .= "Merci de votre confiance,\n";
      $message .= "L'équipe de la boutique en ligne, Manga-k corp.";
      $headers = "From: manga-k.corp@gmail.com";
      // Vérifie que le mail soit envoyer
      if (mail($to, $subject, $message, $headers)) {
         return $this->sendMailGerant();
         return true;
      } else {
         return false;
      }
   }

   /**
    * Fonction qui envois un mail au gérant après commande
    *
    * Cela ne marche pas, car notre hébergeur n'accepte pas l'envois de mail et n'a pas de server pour envoyer des mails
    * @return void
    */
   public function sendMailGerant()
   {
      $to = "gerant@gmail.com";
      $subject = "Une commande vient d'être effectuée";
      $message = "Bonjour Manga-k. gérant,\n\n";
      $message .= "Une commande vient d'être effectuée par " . $this->prenom_acheteur . " " . $this->nom_acheteur . " le " . $this->date_creation . ":\n\n";
      $message .= "Produits achetés:\n";
      // On créer le message avec la liste des produits avec leur quantite et leur prix
      foreach ($this->listeProduits as $key => $value) {
         $message .= $value["titreProduit"] . " x" . $this->panierQuantite[$value["id_produit"]] . " : " . $value["prixPublic"] * $this->panierQuantite[$value["id_produit"]] . "€\n";
      }
      $message .= "\n";
      $message .= "Prix total HT: " . $this->prixTotalHT . "€\n";
      $message .= "Prix total TTC: " . $this->prixTotalTTC . "€\n";
      $message .= "\n";
      $message .= "Message automatique,\n";
      $message .= "L'équipe de la boutique en ligne, Manga-k corp.";
      $headers = "From: manga-k.corp@gmail.com";
      // Vérifie que le mail soit envoyer
      if (mail($to, $subject, $message, $headers)) {
         return true;
      } else {
         return false;
      }
   }

   /**
    * Met à jour la BDD
    *
    * @return void
    */
   function updateBDD()
   {
      // On ajuste les stocks
      foreach ($this->panierQuantite as $key => $value) {
         // On vérifie qu'on peut bien acheter le produit
         $sql = "SELECT quantite FROM gestionStock WHERE id_produit = :id_produit";
         $stmt = $this->pdo->prepare($sql);
         $stmt->bindParam(':id_produit', $key);
         $stmt->execute();
         $result = $stmt->fetch(PDO::FETCH_ASSOC);

         // Si la quantité est inférieur à la quantité demandé, on ne peut pas acheter
         if ($result["quantite"] < $value) {
            return 'Un produit de votre panier n\'est plus disponible en stock.';
         } else if($result["quantite"] == $value) {
            // On avertit le gérant que le produit est en rupture de stock
            $this->sendMailGerantStock($key);
         } 
         $sql = "UPDATE gestionStock SET quantite = quantite - :quantiteAchat WHERE id_produit = :id_produit";
         $stmt = $this->pdo->prepare($sql);
         $stmt->bindParam(':quantiteAchat', $value);
         $stmt->bindParam(':id_produit', $key);
         $stmt->execute();
      }
      if ($stmt->rowCount() == 0) {
         return false;
      }

      // On ajoute la facture
      $id_client = $_SESSION["user"]["id_client"];

      // On encode la liste des produits en JSON
      $this->listeProduits = json_encode($this->listeProduits);
      $requeteFacture = $this->pdo->query("INSERT INTO facturation (id_panier, id_client, listeProduit, dateCreation, prixTotal) 
                                    VALUES ($this->id_panier, $id_client,'$this->listeProduits', CURRENT_DATE(), $this->prixTotalTTC);");
      if ($requeteFacture->rowCount() == 0) {
         return false;
      }

      // On vide le panier et vérifie que le panier soit bien vide
      $requeteUpdatePanier = $this->pdo->query("UPDATE panier SET produits = '[]' WHERE id_client = $id_client;");

      $check = $this->pdo->query("SELECT * FROM panier WHERE id_client = $id_client");
      if ($check->rowCount() != 0) {
         return false;
      }
      return true;
   }

   /**
    * Fonction qui envois un mail au gérant si un stock atteint 0
    *
    * Cela ne marche pas, car notre hébergeur n'accepte pas l'envois de mail et n'a pas de server pour envoyer des mails
    * @return void
    */
   public function sendMailGerantStock($produit)
   {
      $to = "gerant@gmail.com";
      $subject = "Produit rupture stock";
      $message = "Bonjour Manga-k. gérant,\n\n";
      $message .= "Le produit " . $produit . " vient d'atteindre 0 en stock.\n\n";
      $message .= "Message automatique,\n";
      $message .= "L'équipe de la boutique en ligne, Manga-k corp.";
      $headers = "From: manga-k.corp@gmail.com";
   }
}
