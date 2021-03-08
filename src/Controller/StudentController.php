<?php

namespace App\Controller;

use App\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;


class StudentController extends AbstractController
{
    /**
     * @Route("/students", name="students_show_all")
     * @return Response
     */
    public function show_all(): Response
    {
        $list = $this->getDoctrine()
            ->getRepository(Student::class)
            ->findAll();
        if (!$list) {
            throw $this->createNotFoundException(
                'No students found'
            );
        }
        return $this->render('student/students.html.twig',
            ['list' => $list]
        );
    }

    /**
     * @Route("/student/{id}", name="get_student")
     */
    public function getById(Request $request, $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $studentinfo = $entityManager->getRepository(Student::class)->find($id);

        # create a form with contents from the object
        $form = $this->createFormBuilder($studentinfo)
            ->add('title', TextType::class, ['label' => 'Title'])
            ->add('name', TextType::class, ['label' => 'Name'])
            ->add('email', TextType::class, ['label' => 'E-mail'])
            ->add('save', SubmitType::class, ['label' => 'Save'])
            ->getForm();

        # this will not have an effect in first request (via get)
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $studentData = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($studentData);
            $entityManager->flush();

            return $this->redirectToRoute('students_show_all');
        }
        # render it in a twig template
        return $this->render('student/form_student.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
