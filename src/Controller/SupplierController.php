<?php
  namespace App\Controller;

  use App\Entity\Supplier;

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
         * @Route("/", name="supplier_list")
         * @Method({"GET"})
         */
        public function index() {  
            $suppliers = $this->getDoctrine()->getRepository
            (Supplier::class)->findall();

            return $this->render('suppliers/suppliers.html.twig', [
                'suppliers' => $suppliers,
            ]);
        }


        /**
         * @Route("/create", name="create_article")
         * Method({GET, POST})
         */
        public function store(Request $request)
        {

            $supplier = new Supplier();
            $form = $this->createFormBuilder($supplier)
            ->add('name', textType::class, array('attr'=> array(
                'class' => 'form-control'
            )))
            ->add('email', textType::class, array('attr'=> array(
                'class' => 'form-control'
            )))
            ->add('phone', textType::class, array('attr'=> array(
                'class' => 'form-control'
            )))
            ->add('type', textType::class, array('attr'=> array(
                'class' => 'form-control'
            )))
            ->add('mode', textType::class, array('attr'=> array(
                'class' => 'form-control'
            )))
           /*  ->add('created_at', textType::class, array('attr'=> array(
                'class' => 'form-control'
            )))
            ->add('updated_at', textType::class, array('attr'=> array(
                'class' => 'form-control'
            ))) */
            ->add('save', submitType::class, array(
                'label' => 'save',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()) {
                $supplier = $form->getData();
        
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($supplier);
                $entityManager->flush();
        
                return $this->redirectToRoute('supplier_list');
              }
        
              return $this->render('suppliers/newSup.html.twig', array(
                'form' => $form->createView()
              ));
        }

        public function show(){

        }

      
        /**
         * @Route("/supplier/save")
         */
        /* public function save(){
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
        } */
    }