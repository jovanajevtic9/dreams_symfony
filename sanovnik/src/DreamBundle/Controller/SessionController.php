<?php
/**
 * Created by PhpStorm.
 * User: jovana
 * Date: 2/16/2016
 * Time: 5:26 PM
 */

namespace DreamBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class SessionController extends Controller
{

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
        $session = new Session();
        $session->clear();
        $this->addFlash(
            'notice',
            'Uspesno ste se izlogovali!'
        );

        return $this->redirectToRoute("index");

    }

    /**
     * @Route("/likesDream/{id}", name="dream_likes")
     */
    public function asdasdadAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session = new Session();
        $product = $em->getRepository('DreamBundle:Dream')->find($id);
        /* add like in users's liked dreams */
        $user = $em->getRepository('DreamBundle:User')->find($session->get('id'));



        if(unserialize($user->getDislikeDreams())!==false) {
            $dislikedDreams = unserialize($user->getDislikeDreams());
            if (($key = array_search($id, $dislikedDreams)) !== false) {
                unset($dislikedDreams[$key]);
                $user->setDislikeDreams(serialize($dislikedDreams));
                $em->flush();
                $dislike = $product->getUnlikes()-1;
                $product->setUnlikes($dislike);
                $em->flush();
            }

        }


        if(unserialize($user->getLikeDreams())){
            $likedDreams = unserialize($user->getLikeDreams());
            array_push($likedDreams, $id);
        }

        else {
            $likedDreams = array($id);
        }

        $user->setLikeDreams(serialize($likedDreams));
        $em->flush();
        $likes = $product->getLikes()+1;
        $product->setLikes($likes);
        $em->flush();
        $session->set('likedDreams',unserialize($user->getLikeDreams()));
        $session->set('dislikedDreams',unserialize($user->getDislikeDreams()));
        return $this->redirect($request->server->get('HTTP_REFERER'));

    }


    /**
     * @Route("/dislikeDream/{id}", name="dream_dislikes")
     */
    public function dislikeAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session = new Session();
        $product = $em->getRepository('DreamBundle:Dream')->find($id);
        /* add dream id in users's disliked dreams */
        $user = $em->getRepository('DreamBundle:User')->find($session->get('id'));
        /* da li je vec lajkovan */


        if(unserialize($user->getLikeDreams())!==false) {
            $likedDreams = unserialize($user->getLikeDreams());
            if (($key = array_search($id, $likedDreams)) !== false) {
                unset($likedDreams[$key]);
                $user->setLikeDreams(serialize($likedDreams));
                $em->flush();
                $likes = $product->getLikes()-1;
                $product->setLikes($likes);
                $em->flush();
            }


        }



        if(unserialize($user->getDislikeDreams())){
            $dislikedDreams = unserialize($user->getDislikeDreams());
            array_push($dislikedDreams, $id);
        }

        else {
            $dislikedDreams = array($id);
        }

        $user->setDislikeDreams(serialize($dislikedDreams));
        $em->flush();
        $dislikes = $product->getUnlikes()+1;
        $product->setUnlikes($dislikes);
        $em->flush();

        $session=new Session();
        $session->set('likedDreams',unserialize($user->getLikeDreams()));
        $session->set('dislikedDreams',unserialize($user->getDislikeDreams()));
        return $this->redirect($request->server->get('HTTP_REFERER'));

    }

    /**
     * @Route("/dreams/json", name="dreams_json")
     */
    public function getAllDreamsJSONAction()
    {
        $em = $this->getDoctrine()->getManager();
        $dream=$em->getRepository('DreamBundle:Dream')->findOneBy(array('id'=>1));

        $niz = array();

            $niz[] = array(
                'id' => $dream->getId(),
                'likes'=>$dream->getLikes(),
                'unlikes'=>$dream->getUnLikes()
            );

        $response = new Response(json_encode($niz));
        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }


}