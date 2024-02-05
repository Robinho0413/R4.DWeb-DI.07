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

    private array $legos;

    public function __construct()
    {

        $this->legos = [];

        // Chargement du contenu du fichier data.json
        $data = file_get_contents('../src/data.json');
        $json = json_decode($data);


        // Création des objets Lego à partir des données
        foreach ($json as $lego) {
            $legoModel = new Lego($lego->id, $lego->name, $lego->collection);
            $legoModel->setDescription($lego->description);
            $legoModel->setPrice($lego->price);
            $legoModel->setPieces($lego->pieces);
            $legoModel->setBoxImage($lego->images->box);
            $legoModel->setLegoImage($lego->images->bg);

            // Ajout de l'objet Lego au tableau $legos
            array_push($this->legos, $legoModel);
        }

        return $this->legos;
    }


    #[Route('/', )]
    public function home()
    {
        return $this->render('lego.html.twig', ['legos' => $this->legos]);
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


    #[Route('/{collection}', 'filter_by_collection', requirements: ['page' => 'creator|starwars|expert'])]
    public function filter($collection): Response
    {
        return $this->render('lego.html.twig', ['legos' => array_filter($this->legos, function($lego) use ($collection) {
            return strtolower($lego->getCollection()) == str_replace('_',' ', strtolower($collection));
        })]);
    }

}

