<?php

namespace App\Controller;
use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class Controller extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        $entityManager = $this -> getDoctrine()->getManager();
        $BookRepository = $entityManager->getRepository(Book::class);
        $livres = $BookRepository->findAll();

        if(empty($livres)){
            $livre1 = new Book();
            $livre1->setTitre('albert camus l\'étranger');
            $livre1->setDescription('L\'Étranger est le premier roman d’Albert Camus, paru en 1942.');
            $livre1->setNote(5);
            $entityManager->persist($livre1);

            $livre2 = new Book();
            $livre2->setTitre('Victor Hugo Les Misérables');
            $livre2->setDescription('Personne ne tend la main à cet ancien détenu hormis un homme d’église, qui le guide sur la voie de la bonté. Valjean décide alors de vouer sa vie à 
            la défense des miséreux. Son destin va croiser le chemin de Fantine, une mère célibataire prête à tout pour le bonheur de sa fille.');
            $livre2->setNote(5);
            $entityManager->persist($livre2);

            $entityManager->flush();
        }

        return $this->render('/index.html.twig', [
            'livres' => $BookRepository->findAll(),
        ]);
    }
}
