<?php

namespace AppBundle\Controller;


use AppBundle\Entity\ToDo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ToDoController extends Controller
{
    /**
     * @Route("/todo")
     */
    public function listAction(): Response
    {
        $em = $this->getDoctrine()->getManager();

        $todos = $em->getRepository(ToDo::class)
            ->findAllOrderedByDueDate();

        return $this->render('todo/list.html.twig', [
            'todos' => $todos
        ]);
    }
}