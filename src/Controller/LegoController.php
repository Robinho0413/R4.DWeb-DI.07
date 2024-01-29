<?php


/* indique où "vit" ce fichier */
namespace App\Controller;


/* indique l'utilisation du bon bundle pour gérer nos routes */

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use stdClass;

use App\Entity\Lego;

/* le nom de la classe doit être cohérent avec le nom du fichier */
class LegoController extends AbstractController
{

    private $legos = [];

    public function __construct()
    {
        // Construire le chemin complet du fichier data.json en utilisant __DIR__
        $jsonFilePath = __DIR__ . '/../../data.json';

        // Chargement du contenu du fichier data.json
        $jsonData = file_get_contents($jsonFilePath);
        $data = json_decode($jsonData, true);

        // Vérification si le décodage JSON a réussi
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Erreur lors du décodage du fichier JSON');
        }

        // Création des objets Lego à partir des données
        foreach ($data as $legoData) {
            $lego = new Lego($legoData['id'], $legoData['name'], $legoData['collection']);
            $lego->setDescription($legoData['description']);
            $lego->setPrice($legoData['price']);
            $lego->setPieces($legoData['pieces']);
            $lego->setBoximages($legoData['boximages']);
            $lego->setBgimages($legoData['bgimages']);

            // Ajout de l'objet Lego au tableau $legos
            $this->legos[] = $lego;
        }
    }




   // L’attribute #[Route] indique ici que l'on associe la route
   // "/" à la méthode home pour que Symfony l'exécute chaque fois
   // que l'on accède à la racine de notre site.

//    #[Route('/')]
//    public function home(): Response
//    {
//         $cocci = new stdClass();

//         $cocci->collection = "Creator Expert";
//         $cocci->id = 10252;
//         $cocci->name = "La coccinelle Volkwagen";
//         $cocci->description = "Construis une réplique LEGO® Creator Expert de l'automobile la plus populaire au monde. Ce magnifique modèle LEGO est plein de détails authentiques qui capturent le charme et la personnalité de la voiture, notamment un coloris bleu ciel, des ailes arrondies, des jantes blanches avec des enjoliveurs caractéristiques, des phares ronds et des clignotants montés sur les ailes.";
//         $cocci->price = 94.99;
//         $cocci->pieces = 1167;
//         $cocci->boxImage = "LEGO_10252_Box.png";
//         $cocci->legoImage = "LEGO_10252_Main.jpg";

//         return $this->render('lego.html.twig', ['lego' => $cocci,]);
//    }


   #[Route('/me', )]
   public function me()
   {
       die("Robin");
   }
}

