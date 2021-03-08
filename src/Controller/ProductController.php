<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/create/{name}/{price}/{description}", name="create_product")
     */
    public function createProduct($name, $price, $description): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Product();
        $product->setName($name);
        $product->setPrice($price);
        $product->setDescription($description);

        $entityManager->persist($product);
        $entityManager->flush();

        return $this->redirectToRoute('product_show_all');
    }

    /**
     * @Route("/products", name="product_show_all")
     * @return Response
     */
    public function show_all(): Response
    {
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();
        if (!$products) {
            throw $this->createNotFoundException(
                'No product found'
            );
        }
        return $this->render('product/products.html.twig',
                            ['products' => $products]
        );
    }

    /**
     * @Route("/product/{id}/edit", name="update_product")
     * @return Response
     */
    public function update(Request $request, int $id): Response
    {
        if($request->getMethod()=='POST') {
            $entityManager = $this->getDoctrine()->getManager();
            $product = $entityManager->getRepository(Product::class)->find($request->request->get('id'));

            if (!$product) {
                throw $this->createNotFoundException(
                    'No product found for id ' . $request->request->get('id')
                );
            }

            $product->setName($request->request->get('name'));
            $product->setPrice($request->request->getInt('price'));
            $product->setDescription($request->request->get('description'));
            $entityManager->flush();

            return $this->redirectToRoute('product_show_all');
        }
        else{
            $product = $this->getDoctrine()
                ->getRepository(Product::class)
                ->find($id);

            if (!$product) {
                throw $this->createNotFoundException(
                    'No product found for id '.$id
                );
            }
            return $this->render('product/product.html.twig',
                ['product'=>$product]);
        }
    }

    /**
     * @Route("/product/{id}/delete", name="delete_product")
     * @return Response
     */
    public function delete(int $id): Response{
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($product);
        $entityManager->flush();

        return $this->redirectToRoute('product_show_all');
    }
}
