<?php

namespace App\Controller;

use App\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


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
}
