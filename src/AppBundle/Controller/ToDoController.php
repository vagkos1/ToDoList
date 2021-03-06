<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ToDo;
use AppBundle\Form\TodoForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ToDoController extends Controller
{
    /**
     * @Route("/todo", name="todo_list")
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

    /**
     * @Route("/todo/new", name="todo_create")
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(TodoForm::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $todo = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($todo);
            $em->flush();

            $this->addFlash(
                'success',
                'Todo created - well done!'
            );

            return $this->redirectToRoute('todo_list');
        }

        return $this->render('todo/new.html.twig', [
            'todoForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/todo/{id}/edit", name="todo_edit")
     */
    public function editAction(Request $request, ToDo $todo)
    {
        $form = $this->createForm(TodoForm::class, $todo);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $todo = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($todo);
            $em->flush();

            $this->addFlash(
                'success',
                'Todo updated - well done!'
            );

            return $this->redirectToRoute('todo_list');
        }

        return $this->render('todo/edit.html.twig', [
            'todoForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/todo/{slug}", name="todo_show")
     */
    public function showAction(ToDo $todo): Response
    {
        return $this->render('todo/show.html.twig', [
            'todo' => $todo,
        ]);
    }
}
