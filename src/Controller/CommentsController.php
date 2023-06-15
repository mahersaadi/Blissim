<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\Product;
use App\Form\CommentType;
use App\Repository\CommentsRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CommentsController extends AbstractController
{

    /**
     * @Route("/comment/add/{product_id}",name="comment_add")
     */
    public function add(Request $request, $product_id, ProductRepository $productRepository, EntityManagerInterface $em, ValidatorInterface $validator)
    {
        $product = $productRepository->findOneBy([
            'id' => $product_id
        ]);
        $comment = new Comments();
        $formComment = $this->createForm(CommentType::class, $comment);
        $formComment->handleRequest($request);
        if ($formComment->isSubmitted() && $formComment->isValid()) {
            $comment->setProduct($product)
                ->setCreatedAt(new \DateTime())
                ->setUser($this->getUser());
            $em->persist($comment);
            $em->flush();
        }

        return $this->redirectToRoute('product_show', [
            'category_slug' => $product->getCategory()->getSlug(),
            'slug' => $product->getSlug()
        ]);
    }

    /**
     * @Route("/comment/delete/{comment_id}",name="comment_delete")
     */
    public function delete($comment_id, CommentsRepository $commentsRepository, EntityManagerInterface $em, ValidatorInterface $validator)
    {

        $comment = $commentsRepository->findOneBy([
            'id' => $comment_id
        ]);
        $product = $comment->getProduct();

        $em->remove($comment);
        $em->flush();


        return $this->redirectToRoute('product_show', [
            'category_slug' => $product->getCategory()->getSlug(),
            'slug' => $product->getSlug()
        ]);
    }
}
