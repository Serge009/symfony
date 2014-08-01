<?php

namespace Acme\StoreBundle\Controller;

use Acme\StoreBundle\Entity\Category;
use Acme\StoreBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcmeStoreBundle:Default:index.html.twig');
    }

    public function createAction()
    {


        $category = new Category();
        $category->setName('Main Products');

        $product = new Product();
        $product->setName('Foo');
        $product->setPrice(19.99);

        // relate this product to the category
        $product->setCategory($category);
        $em = $this->getDoctrine()->getManager();


        $em->persist($category);
        $em->persist($product);
        $em->flush();

        return new Response(
            '<body>Created product id: '.$product->getId()
            .' and category id: '.$category->getId()
            .'</body>'
        );
    }

    public function showAction($id)
    {
        $product = $this->getDoctrine()
            ->getRepository('AcmeStoreBundle:Product')
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        return new Response('<body>Id = '.$product->getId() . ', name = '. $product->getName() .' </body>');

    }

    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AcmeStoreBundle:Product')->find($id);
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $product->setName('New product name!');
        $em->flush();

        return $this->redirect($this->generateUrl('_store_show_all'));
    }

    public function showAllAction()
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AcmeStoreBundle:Product')
            ->findAllOrderedByName();


        return $this->render('AcmeStoreBundle:Default:products.html.twig', array('products' => $products));

    }
}
