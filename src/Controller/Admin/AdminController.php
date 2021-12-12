<?php

namespace App\Controller\Admin;
use App\Entity\Administrateur;
use App\Entity\User1;
use App\Form\UserType;
use App\Repository\User1Repository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/** @Route ("/admin" , name="admin_")
 * class AdminController
 * @package App\controller\admin
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/home", name ="home")
     */
    public function admin(): Response
    {
        return $this->render('admin/home.html.twig');
    }
    /**
     * liste les utilisateurs du site
     * @Route("/users", name ="utilisateurs")
     */
    public function userslist(User1Repository $User1): Response
    {
        return $this->render('admin/listeutilisateur.html.twig',[
            'user'=> $User1->findAll()
            ]) ;
    }

    /**
     * Modifier un utilisateur
     * @Route("/users/modifier/{id}", name ="modifier_utilisateur")
     */
    public function editUser(User1 $user, Request $request): Response
    {
            $form = $this ->CreateForm(UserType::class , $user);
            $form -> handleRequest($request);
      if($form->isSubmitted() && $form->isValid()){
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager -> persist($user);
          $entityManager->flush();

          $this -> addFlash('message' , 'utilisateur modifié avec succés');
          return $this ->redirectToRoute('admin_utilisateurs');
      }

      return $this->render('admin/edituser.html.twig',
      [ 'userForm' => $form ->createView()]
      );

    }
}
