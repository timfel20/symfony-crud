<?php
  namespace App\Controller;

  use App\Entity\Supplier;

  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\Routing\Annotation\Route;
  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


  class SupplierController extends AbstractController{
    /**
         * @Route("/", name="article_list")
         * @Method({"GET"})
         */
        public function index() {  
            return $this->render('suppliers/suppliers.html.twig', [
                'controller_name' => 'SupplierController',
            ]);
        }

        /**
         * @Route("/supplier/save")
         */
        public function save(){
            $entityManager = $this->getDoctrine()->getManager();
            $supplier = new Supplier;

            //test with random data
            $supplier -> setName("yami Curo");
            $supplier -> setEmail("yamiCuro@gmail.com");
            $supplier -> setPhone(67363884823);
            $supplier -> setType("hdjjd");
            $supplier -> setMode(true);
            $supplier -> setCreated("00:00");
            $supplier -> setUpdated("00:00");
            //to save
            $entityManager->persist($supplier);

            //to execute
            $entityManager->flush();
            return new Response('saved with an id of' .$supplier->getId());
        }
    }