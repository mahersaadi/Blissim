<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoryController extends AbstractController
{
    /**
     * @Route("admin/category/add", name="category_add")
     */
    public function add(Request $request, SluggerInterface $sluggerInterface, EntityManagerInterface $em)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $category->setSlug($sluggerInterface->slug($category->getName()));
            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute('product_category', [
                'slug' => $category->getSlug()
            ]);
        }
        $formView = $form->createView();
        return $this->render('category/add.html.twig', ['form' => $formView]);
    }
    /**
     * @Route("admin/category/edit/{id}", name="category_edit")
     */
    public function edit(Request $request, $id, CategoryRepository $categoryRepository, EntityManagerInterface $em, SluggerInterface $sluggerInterface)
    {
        $category = $categoryRepository->find($id);
        $form = $this->createForm(CategoryType::class);
        $form->setData($category);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em->flush();

            return $this->redirectToRoute('product_category', [
                'slug' => $category->getSlug()
            ]);
        }
        $formView = $form->createView();
        return $this->render('category/edit.html.twig', [
            'form' => $formView,
            'category' => $category
        ]);
    }
}
