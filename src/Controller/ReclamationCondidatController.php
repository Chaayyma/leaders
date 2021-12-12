<?php

namespace App\Controller;

use App\Entity\Formateur;
use App\Form\ReclamationCondidatType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     */
    public function reclamer(EntityManagerInterface $em,Request $request){
        $con=new Formateur();
        $form=$this->createForm(    ReclamationCondidatType::class,$con) ;
        $form->handleRequest($request); // recuperer ma request (les donnees de la request
        if($form->isSubmitted()&& $form->isValid()){
            $em->persist($con);//preparation  de l'objet a envoyé
            $em->flush(); // envoie =insertion dans la base
            //return $this->redirectToRout('listes') ;
        }
        return $this->render('reclamtion_condidat/reclamer.html.twig', [
            'formReclamation'=>$form->createView(),

        ]);
    }
}
