<?php

namespace App\Controller;

use App\Entity\Condidat;
use App\Entity\Etudiants;
use App\Form\CondidatType;
use App\Form\EtudiantType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriCondidatController extends AbstractController
{
    /**
     * @Route("/inscri/condidat", name="inscri_condidat")
     */
    public function index(): Response
    {
        return $this->render('inscri_condidat/index.html.twig', [
            'controller_name' => 'InscriCondidatController',
        ]);
    }
    /**
     * @Route("/ajouterc", name="condidat")
     */
    public function ajoute(EntityManagerInterface $em,Request $request){
        $con=new Condidat();
        $form=$this->createForm(    CondidatType::class,$con) ;
        $form->handleRequest($request); // recuperer ma request (les donnees de la request
        if($form->isSubmitted()&& $form->isValid()){
            $em->persist($con);//preparation  de l'objet a envoyé
            $em->flush(); // envoie =insertion dans la base
            //return $this->redirectToRout('listes') ;
        }
        return $this->render('inscri_condidat/inscri.html.twig', [
            'forminscription'=>$form->createView(),

        ]);
    }
}