<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use FOS\UserBundle\Model\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    /**
     * @Route("/homepage", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

                                                                                                                                                                                           
    /**
     * @Route("/", name="home")
     */
    public function homeAction(){

        return $this->render('carousel.html.twig');
    }

    /**
     * @Route("/admin/admin", name="admin")
     */
    public function adminAction()
    {


        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $utilisateurs = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('admin/admin.html.twig', array(
            'user' => $user, 'utilisateurs' => $utilisateurs , ));
    }

    /**
     * @Route("/admin/supp/{username}", name="supp")
     */
    public function suppressionAction($username)
    {

        $UserManager = $this->container->get('fos_user.user_manager');

        $user = $UserManager->findUserByUsername($username);


        if ($user ==  null) {
            throw new NotFoundHttpException('User not found for user ' . $user);
        }

        $UserManager->deleteUser( $user);


            return $this->redirectToRoute('home');
    }

    /**
     * @Route("/admin/supp2/{username}", name="supp2")
     */
    public function suppression2Action($username)
    {

        $UserManager = $this->container->get('fos_user.user_manager');

        $user = $UserManager->findUserByUsername($username);


        if ($user ==  null) {
            throw new NotFoundHttpException('User not found for user ' . $user);
        }

        $UserManager->deleteUser( $user);
        $this->addFlash(
            'notice',
            'Compte '.$username.' Supprimer!'
        );

        return $this->redirectToRoute('admin');
    }





}
