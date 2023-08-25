<?php

namespace App\Controller;

use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTimeImmutable;

class MessageController extends AbstractController
{
    #[Route('/message', name: 'app_message', methods: ['POST'])]
    public function index(Request $req, MessageRepository $repo): Response
    {
        if (!$req->getPayload()->has('auteur') || !$req->getPayload()->has('content')) {
            return $this->json(['message' => 'Auteur et contenu obligatoire']);
        }
        // Recuperer les donnees de la requete
        $auteur = $req->getPayload()->get('auteur');
        $content = $req->getPayload()->get('content');

        // creer une nouvel entite et ajouter les donnees
        $message = new \App\Entity\Message();
        $message->setAuteur($auteur);
        $message->setContent($content);
        $message->setCreateAt(new DateTimeImmutable());
        // Enregistrer le message dans la base de données
        $repo->save($message, true);

        return $this->json([
            'id' => $message->getId(),
            'auteur' => $message->getAuteur(),
            'content' => $message->getContent()
        ]);
    }
}
