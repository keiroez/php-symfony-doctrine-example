<?php

namespace App\Controller;

use App\Entity\Inscricao;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class InscricaoController extends AbstractController
{
    /**
     * @Route("/inscricao", name="inscricao")
     */
    public function index(): Response
    {
        return $this->render('inscricao/index.html.twig',
            ['errors' => '']
        );
    }

    /**
     * @Route("/inscricao/create", name="create_inscricao")
     */
    public function createInscricao(ValidatorInterface $validator, Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $inscricao = new Inscricao();
        $inscricao->setNome($request->request->get('nome'));
        $inscricao->setSobrenome($request->request->get('sobrenome'));
        $inscricao->setIdade($request->request->getInt('idade'));
        $inscricao->setEmail($request->request->get('email'));

        $errors = $validator->validate($inscricao);
        if(count($errors) > 0){
            return $this->render('inscricao/index.html.twig', [
                'errors' => $errors
            ]);
        }

        $entityManager->persist($inscricao);
        $entityManager->flush();
        $this->addFlash("ok", "Inscrição de ".$inscricao->getNome(). " efetuada!");

        return $this->render('inscricao/index.html.twig', ['errors' => '']);
    }
}
