<?php
  namespace App\Controller;

  use App\Entity\Article;

  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\Routing\Annotation\Route;
  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


  use Symfony\Component\Form\Extension\Core\Type\TextType;
  use Symfony\Component\Form\Extension\Core\Type\TextareaType;
  use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
  }