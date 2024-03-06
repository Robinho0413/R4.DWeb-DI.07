<?php


/* indique où "vit" ce fichier */
namespace App\Controller;


/* indique l'utilisation du bon bundle pour gérer nos routes */

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use stdClass;
use App\Service\CreditsGenerator;


use App\Entity\Lego;
use App\Service\DatabaseInterface;
use Symfony\Flex\Response as FlexResponse;

/* le nom de la classe doit être cohérent avec le nom du fichier */
class LegoController extends AbstractController
{

    // #[Route('/', )]
    // public function home()
    // {
    //     return $this->render('lego.html.twig', ['legos' => $this->legos]);
    // }


    #[Route('/', )]
    public function home(DatabaseInterface $dbinterface): Response
    {
        $legos = $dbinterface->getAllLegos();
        return $this->render('lego.html.twig', ['legos' => $legos]);
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


    #[Route('/{collection}', 'filter_by_collection', requirements: ['collection' => 'creator|star_wars|creator_expert|harry_potter'])]
    public function filter(DatabaseInterface $dbinterface, $collection): Response
    {
        $collectionMAJ = str_replace('_',' ', strtolower($collection));

        $legos = $dbinterface->getLegosByCollection($collectionMAJ);

        return $this->render('lego.html.twig', ['legos' => $legos]);



        // return $this->render('lego.html.twig', ['legos' => array_filter($this->legos, function($lego) use ($collection) {
        //     return strtolower($lego->getCollection()) == str_replace('_',' ', strtolower($collection));
        // })]);
    }


    #[Route('/credits', 'credits')]
    public function credits(CreditsGenerator $credits): Response
    {
        return new Response($credits->getCredits());
    }



}

