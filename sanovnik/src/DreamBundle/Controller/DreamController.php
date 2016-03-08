<?php
/**
 * Created by PhpStorm.
 * User: jovana
 * Date: 2/12/2016
 * Time: 7:39 PM
 */

namespace DreamBundle\Controller;


use DreamBundle\Entity\Dream;
use DreamBundle\Entity\User;
use DreamBundle\Form\DreamType;
use DreamBundle\Form\LoginType;
use DreamBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class DreamController extends Controller
{
    /**
     * @Route("/sort/best", name="best")
     */
    public function bestAction()
    {
        $em = $this->getDoctrine()->getManager();
        $dreams = $em->getRepository('DreamBundle:Dream')->getBestDreams();

        return $this->render('DreamBundle:Page:index.html.twig', array(
            'dreams'=>$dreams
        ));

    }
    /**
     * @Route("/sort/new", name="new")
     */
    public function newAction()
    {
        $em = $this->getDoctrine()->getManager();
        $dreams = $em->getRepository('DreamBundle:Dream')->getNewDreams();

        return $this->render('DreamBundle:Page:index.html.twig', array(
            'dreams'=>$dreams
        ));

    }
    /**
     * @Route("/sort/popular", name="popular")
     */
    public function popularAction()
    {
        $em = $this->getDoctrine()->getManager();
        $dreams = $em->getRepository('DreamBundle:Dream')->getPopularDreams();

        return $this->render('DreamBundle:Page:index.html.twig', array(
            'dreams'=>$dreams
        ));
    }
    /**
     * @Route("/create", name="create")
     */
    public function createDreamAction(Request $request)
    {
        $dream = new Dream();


        $form = $this->createForm(DreamType::class,$dream);


        $form->handleRequest($request);

        return $this->render('DreamBundle:Page:sidebar.html.twig', array(
            'form'=>$form->createView()
        ));
    }
    /**
     * @Route("/create/dream", name="createDream")
     */
    public function createAction(Request $request)

    {
        $dream = new Dream();
        $form = $this->createForm(DreamType::class,$dream);
        $form->handleRequest($request);

        $dream->setText( $form['text']->getData());
        $dream->setCreated( new\DateTime('now'));
        $dream->setLikes(0);
        $dream->setUnlikes(0);

        $session = new Session();
        $em = $this->getDoctrine()->getManager();
        $user=$em->getRepository('DreamBundle:User')->find($session->get('id'));

        $dream->setUser($user);



        $em->persist($dream);
        $em->flush();
        $this->addFlash(
            'notice',
            'Dream added'
        );
        return $this->redirectToRoute('best');

    }


}