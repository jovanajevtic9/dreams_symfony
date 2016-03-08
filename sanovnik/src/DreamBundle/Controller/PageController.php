<?php
/**
 * Created by PhpStorm.
 * User: jovana
 * Date: 2/11/2016
 * Time: 8:14 PM
 */

namespace DreamBundle\Controller;

use DreamBundle\Entity\Comment;
use DreamBundle\Entity\User;
use DreamBundle\Form\CommentType;
use DreamBundle\Form\LoginType;
use DreamBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
$session = new Session();




class PageController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $dreams = $em->getRepository('DreamBundle:Dream')->getPopularDreams();

        return $this->render('DreamBundle:Page:index.html.twig', array(
            'dreams'=>$dreams
        ));
    }

    /**
     * @Route("/dream/{id}", name="show_dream")
     */
    public function showDreamAction($id, Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $dream = $em->getRepository('DreamBundle:Dream')->find($id);

        return $this->render('DreamBundle:Page:dream.html.twig', array(
            'dream'=>$dream,

        ));
    }

    /**
     * @Route("/showrss", name="showRss")
     */
    public function showRssAction()
    {


        return $this->render('DreamBundle:Page:rss.html.twig');
    }



    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {

        $user = new User();


        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);


        return $this->render('DreamBundle:Page:register.html.twig', array(
            'form' => $form->createView(),
        ));

    }
    /**
     * @Route("/profile", name="profile")
     */
    public function showProfileAction()
    {
        $em = $this->getDoctrine()->getManager();
        $session = new Session();
        $dreams = $em->getRepository('DreamBundle:Dream')->findByUser($session->get('id'));

        return $this->render('DreamBundle:Page:profile.html.twig', array(
            'dreams'=>$dreams
        ));

    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {

        $user = new User();
        $form = $this->createForm(LoginType::class, $user);
        $form->handleRequest($request);
        return $this->render('DreamBundle:Page:login.html.twig', array(
            'form' => $form->createView(),
        ));

    }



    /**
     * @Route("/loginUser", name="loginUser")
     */
    public function loginUserAction(Request $request)
    {

        $user = new User();
        $form = $this->createForm(LoginType::class, $user);
        $form->handleRequest($request);

        $user->setUsername($form->get('username')->getData());
        $user->setPassword($form->get('password')->getData());
        $em = $this->getDoctrine()->getManager();
        if($em->getRepository('DreamBundle:User')->findOneBy(array('username' => $user->getUsername(), 'password'=> $user->getPassword()))==null){
            $this->addFlash(
                'error',
                'Pogresan username i password!'
            );
        }
        else {
            $user1=$em->getRepository('DreamBundle:User')->findOneBy(array('username' => $user->getUsername(), 'password'=> $user->getPassword()));

            $session = new Session();
            $session->set('likedDreams',unserialize($user1->getLikeDreams()));
            $session->set('dislikedDreams',unserialize($user1->getDislikeDreams()));
            $session->set('username', $user1->getUsername());
            $session->set('id', $user1->getId());

            $this->addFlash(
                'notice',
                'Uspesno logovanje'
            );


        }



        return $this->redirectToRoute("index");

    }

    /**
     * @Route("/createUser", name="createUser")
     */
    public function createUserAction(Request $request)
    { $user = new User();


        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        $user->setEmail($form->get('email')->getData());
        $user->setUsername($form->get('username')->getData());
        $user->setPassword($form->get('password')->getData());
        $user->setRegDate(new \DateTime('today'));


        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        $this->addFlash(
            'notice',
            'Uspesno ste se registrovali!'
        );


        return $this->redirectToRoute("index");

    }
}