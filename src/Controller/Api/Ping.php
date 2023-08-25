<?php
// /src/Controller/MonController.php
namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// 1. Renommer la classe
class Ping extends AbstractController
{

    // 2. Configurer l'url, le nom et les méthodes de la route
    #[Route('/api/ping', name: 'ping', methods: ['GET'])]

    // 3. Renommer les paramètre et injecter des données
    function index(): Response
    {

        // A. Utiliser Request $requete pour récuperer des donnés

        // B. Rétourner une réponse
        return $this->json(['message' => 'pong']);
    }
}
