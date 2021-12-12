<?php

namespace App\Controller;

use App\Entity\Formateur;
use App\Entity\User1;
use App\Form\ReclamationCondidatType;
use App\Repository\User1Repository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReclamationCondidatController extends AbstractController
{
    /**
     * @Route("/reclamation/condidat", name="reclamation_condidat")
     */
    public function index(): Response
    {
        return $this->render('reclamation_condidat/index.html.twig', [
            'controller_name' => 'ReclamationCondidatController',
        ]);
    }

    /**
     * @Route("/reclamer", name="reclamation_condidat")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param User1Repository $User1
     * @return Response
     */
    public function reclamer(EntityManagerInterface $em,Request $request ,User1Repository $User1 ){
        $con=new Formateur();
        $form=$this->createForm(    ReclamationCondidatType::class,$con) ;
        $form->handleRequest($request); // recuperer ma request (les donnees de la request
        if($form->isSubmitted()&& $form->isValid()){
            $em->persist($con);//preparation  de l'objet a envoyé
            $em->flush(); // envoie =insertion dans la base
            //return $this->redirectToRout('listes') ;
        }

            return $this->render('reclamation_condidat/reclamer.html.twig',[
                'user'=>$User1 ->findAll()
            ]) ;
    }
}
