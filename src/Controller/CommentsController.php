<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\Product;
use App\Form\CommentType;
use App\Repository\CommentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CommentsController extends AbstractController
{
    /**
     * @Route("/comments", name="app_comments")
     */
    public function index(): Response
    {
        return $this->render('comments/index.html.twig', [
            'controller_name' => 'CommentsController',
        ]);
    }
    /**
     * @Route("/product/comment/add",name="comment_add")
     */
    public function add(Request $request, EntityManagerInterface $em, ValidatorInterface $validator)
    {
        $comment = new Comments();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        dd($request);
    }
}
