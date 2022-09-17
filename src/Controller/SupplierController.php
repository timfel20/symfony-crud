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
  use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
  use Symfony\Component\HttpKernel\Event\ResponseEvent;
  use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


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
                'class' => 'form-control mb-2'
            )))
            ->add('email', textType::class, array('attr'=> array(
                'class' => 'form-control mb-2'
            )))
            ->add('phone', textType::class, array('attr'=> array(
                'class' => 'form-control'
            )))
            ->add('type', ChoiceType::class, array(
                'attr' => array('class' => 'btn btn-primary mt-3 mb-3 ml-3' ),
                'choices' => array(
                'hotel' => 'hotel', 
                'court' => 'court', 
                'complement' => 'complement'
                )
            ))
            ->add('status', CheckboxType::class, array(
                'attr' => array('class' => 'btn btn-primary mt-3 mb-3 ml-2' ),
                'label'    => 'active?',
                'required' => false,
            ))
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

                $this->addFlash('notice','Saved successfully');
        
                return $this->redirectToRoute('supplier_list');
              }
        
              return $this->render('suppliers/newSup.html.twig', array(
                'form' => $form->createView()
              ));
        }

         /**
         * @Route("/delete/{id}", name="delete_list")
         * @Method({"DELETE"})
         */
        public function delete(Request $request, $id) {
            $target = $this->getDoctrine()->getRepository(Supplier::class)->find($id);
      
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($target);
            $entityManager->flush();
      
            $response = new Response();
            $response->send();

            return $this->redirectToRoute('supplier_list');
          }

      

    /**
     * @Route("/edit/{id}", name="edit_suppliers")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id) {
        $supplier = new Supplier();

        $supplier = $this->getDoctrine()->getRepository(Supplier::class)->find($id);
        $form = $this->createFormBuilder($supplier)
        ->add('name', textType::class, array('attr'=> array(
            'class' => 'form-control mb-2'
        )))
        ->add('email', textType::class, array('attr'=> array(
            'class' => 'form-control mb-2'
        )))
        ->add('phone', textType::class, array('attr'=> array(
            'class' => 'form-control'
        )))
        ->add('type', ChoiceType::class, array(
            'attr' => array('class' => 'btn btn-primary mt-3 mb-3 ml-3' ),
            'choices' => array(
            'hotel' => 'hotel', 
            'court' => 'court', 
            'complement' => 'complement'
            )
        ))
        ->add('status', ChoiceType::class, array(
            'attr' => array('class' => 'btn btn-primary mt-3 mb-3 ml-2' ),
            'choices' => array(
            'active' => 'active', 
            'inactive' => 'inactive', 
            )
        ))
        ->add('save', submitType::class, array(
            'label' => 'save',
            'attr' => array('class' => 'btn btn-primary mt-3')
        ))
        ->getForm();
  
        $form->handleRequest($request);
  
        if($form->isSubmitted() && $form->isValid()) {
  
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->flush();
  
          return $this->redirectToRoute('supplier_list');
        }
  
        return $this->render('suppliers/edit.html.twig', array(
          'form' => $form->createView()
        ));
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