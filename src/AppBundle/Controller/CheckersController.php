<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Checkers;
use AppBundle\Entity\CheckersMoves;

class CheckersController extends Controller
{

    public function allAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Checkers')->findAll();

        return $this->render('AppBundle:Checkers:all.html.twig', array(
            'entities' => $entities,
        ));
    }



   public function createAction(Request $request)
    {
        $entity = new Checkers();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $color;
            if ($form->get('whites')->isClicked()) {
                 $color = "white";
            }
            else {
                $color="black";
            }

            $player = $color;
            $opponent = "black";
            if ($color == "black"){
                $opponent = "white";
            }

            $entity
            ->setA1($player)
            ->setA3($player)
            ->setB2($player)
            ->setC1($player)
            ->setC3($player)
            ->setD2($player)
            ->setE1($player)
            ->setE3($player)
            ->setF2($player)
            ->setG1($player)
            ->setG3($player)
            ->setH2($player)

            ->setA7($opponent)
            ->setB6($opponent)
            ->setB8($opponent)
            ->setC7($opponent)
            ->setD6($opponent)
            ->setD8($opponent)
            ->setE7($opponent)
            ->setF6($opponent)
            ->setF8($opponent)
            ->setG7($opponent)
            ->setH6($opponent)
            ->setH8($opponent)

            ->setA5("none")
            ->setB4("none")
            ->setC5("none")
            ->setD4("none")
            ->setE5("none")
            ->setF4("none")
            ->setG5("none")
            ->setH4("none")

            ->setTurn("whites");

            if($player == "white"){
                $entity->setWhites("player")->setBlacks("AI");
            }
            else{
                $entity->setWhites("AI")->setBlacks("player");
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('checkers', array(
                'id'    =>  $entity->getId())));
        }

        return $this->render('AppBundle:Checkers:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    private function createCreateForm(Checkers $entity)
    {

        $form = $this->createFormBuilder($entity, 
            array('action' => $this->generateUrl('checkers_create'),
            'method' => 'POST'))
        ->add('whites', 'submit', array('label' => 'Whites'))
        ->add('blacks', 'submit', array('label' => 'Blacks'))
        ->getForm();

        return $form;
    }

    public function newAction()
    {
        $entity = new Checkers();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:Checkers:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function indexAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Checkers')->find($id);
        
        $form = $this->createFormBuilder($entity, 
            array('action' => $this->generateUrl('checkers', array('id' => $entity->getId())),
            'method' => 'PUT'))

        ->add('a1', 'hidden', array('data' => $entity->getA1()))
        ->add('a3', 'hidden', array('data' => $entity->getA3()))
        ->add('a5', 'hidden', array('data' => $entity->getA5()))
        ->add('a7', 'hidden', array('data' => $entity->getA7()))
        ->add('b2', 'hidden', array('data' => $entity->getB2()))
        ->add('b4', 'hidden', array('data' => $entity->getB4()))
        ->add('b6', 'hidden', array('data' => $entity->getB6()))
        ->add('b8', 'hidden', array('data' => $entity->getB8()))
        ->add('c1', 'hidden', array('data' => $entity->getC1()))
        ->add('c3', 'hidden', array('data' => $entity->getC3()))
        ->add('c5', 'hidden', array('data' => $entity->getC5()))
        ->add('c7', 'hidden', array('data' => $entity->getC7()))
        ->add('d2', 'hidden', array('data' => $entity->getD2()))
        ->add('d4', 'hidden', array('data' => $entity->getD4()))
        ->add('d6', 'hidden', array('data' => $entity->getD6()))
        ->add('d8', 'hidden', array('data' => $entity->getD8()))
        ->add('e1', 'hidden', array('data' => $entity->getE1()))
        ->add('e3', 'hidden', array('data' => $entity->getE3()))
        ->add('e5', 'hidden', array('data' => $entity->getE5()))
        ->add('e7', 'hidden', array('data' => $entity->getE7()))
        ->add('f2', 'hidden', array('data' => $entity->getF2()))
        ->add('f4', 'hidden', array('data' => $entity->getF4()))
        ->add('f6', 'hidden', array('data' => $entity->getF6()))
        ->add('f8', 'hidden', array('data' => $entity->getF8()))
        ->add('g1', 'hidden', array('data' => $entity->getG1()))
        ->add('g3', 'hidden', array('data' => $entity->getG3()))
        ->add('g5', 'hidden', array('data' => $entity->getG5()))
        ->add('g7', 'hidden', array('data' => $entity->getG7()))
        ->add('h2', 'hidden', array('data' => $entity->getH2()))
        ->add('h4', 'hidden', array('data' => $entity->getH4()))
        ->add('h6', 'hidden', array('data' => $entity->getH6()))
        ->add('h8', 'hidden', array('data' => $entity->getH8()))
        ->add('turn', 'hidden', array('data' => $entity->getTurn()))
        ->getForm();

        $form->handleRequest($request);

        $uow = $em->getUnitOfWork();
        $uow->computeChangeSets();
        $changeset = $uow->getEntityChangeSet($entity); // get only changed values

        $moves = new CheckersMoves($changeset, $entity);

        $deleteForm = $this->createDeleteForm($id);
        if ($form->isValid()) {
            $em->flush();
            return $this->render('AppBundle:Checkers:index.html.twig', array(
                'id'            => $id,
                'moves'         => $moves,
                'entity'        => $entity,
                'form'          => $form->createView(),
                'delete_form'   => $deleteForm->createView()
            ));
        }


        return $this->render('AppBundle:Checkers:index.html.twig', array(
            'id'            => $id,
            'moves'         => $moves,
            'entity'        => $entity,
            'form'          => $form->createView(),
            'delete_form'   => $deleteForm->createView()
            ));
    }


    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Checkers')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('checkers_all'));
    }


    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('checkers_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete this game'))
            ->getForm()
        ;
    }

}
