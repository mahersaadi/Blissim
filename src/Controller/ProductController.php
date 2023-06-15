<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Comments;
use App\Entity\Product;
use App\Form\CommentType;
use App\Form\ProductType;
use App\Repository\CategoryRepository;
use App\Repository\CommentsRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProductController extends AbstractController
{
    /**
     * @Route("/{slug}", name="product_category")
     */
    public function category($slug, CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository->findOneBy(['slug' => $slug]);

        if (!$category) {
            throw new NotFoundHttpException("La catégorie n'existe pas!");
        }

        return $this->render('product/category.html.twig', [
            'slug' => $slug,
            'category' => $category
        ]);
    }
    /**
     * @Route("/{category_slug}/{slug}",name="product_show")
     */
    public function show(Request $request, $slug, ProductRepository $productRepository, CommentsRepository $commentsRepository, EntityManagerInterface $em)
    {

        $product = $productRepository->findOneBy([
            'slug' => $slug
        ]);
        $aComments = $commentsRepository->findby(['product' => $product], ['id' => 'DESC']);
        $formComment = $this->createForm(CommentType::class);
        if (!$product) {
            throw new NotFoundHttpException("Le produit n'existe pas!");
        }
        $formView = $formComment->createView();

        return $this->render('product/show.html.twig', [
            'product' => $product, 'formComment' => $formView, 'aComments' => $aComments
        ]);
    }

    /**
     * @Route("/admin/product/add",name="product_add")
     */
    public function add(Request $request, SluggerInterface $sluggerInterface, EntityManagerInterface $em, ValidatorInterface $validator)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $product->setSlug(strtolower($sluggerInterface->slug($product->getName())));
            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('product_show', [
                'category_slug' => $product->getCategory()->getSlug(),
                'slug' => $product->getSlug()
            ]);
        }

        $formView = $form->createView();
        return $this->render('product/add.html.twig', ['form' => $formView]);
    }
    /**
     * @Route("/admin/product/edit/{id}",name="product_edit")
     */
    public function edit(Request $request, $id, ProductRepository $productRepository, EntityManagerInterface $em, ValidatorInterface $validator)
    {
        $product = $productRepository->find($id);
        $form = $this->createForm(ProductType::class);
        $form->setData($product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('product_show', [
                'category_slug' => $product->getCategory()->getSlug(),
                'slug' => $product->getSlug()
            ]);
        }


        $formView = $form->createView();
        return $this->render('product/edit.html.twig', [
            'form' => $formView,
            'product' => $product
        ]);
    }
}
