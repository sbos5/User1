<?php
namespace App\Controller;
use App\Entity\Customer;
use App\Form\CustomerType;
use App\Repository\CustomerRepository;
 use Symfony\Component\Routing\Annotation\Route;
 use Symfony\Component\HttpFoundation\JsonResponse;
 use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



/**
 * Description of CrudController
 *
 * @author Sławomir
 */
class CrudController extends AbstractController 
{
     private $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }
  
 /**
  *  @Route("/show", name="show_customers", methods={"GET"})
  */ 
 public function Show() {
    $tab= $this->customerRepository->findAll();
    return $this->render('show_user.html.twig',['tab'=>$tab]);
}
 /**
  *  @Route("/show/{id}", name="show_customer", methods={"GET"})
  */
 public function ShowId($id) {
    $tab1= $this->customerRepository->find($id);
    return $this->render('show_user1.html.twig',['tab'=>$tab1]);
}
 /**
  *  @Route("/newUser", name="new_customer", methods={"GET","POST"})
  */ 
 public function newUser(Request $request)
 { 
     $customer=new Customer();
      

    $form = $this->createForm(CustomerType::class, $customer);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $customer = $form->getData();

        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($customer);
         $entityManager->flush();

        return $this->redirectToRoute('strona1');
    }
   
    return $this->render('customer_new.html.twig', [
        'form' => $form->createView(),
    ]);
        return $this->render('show_user.html.twig',['tab'=>$tab]);
}
 /**
  *  @Route("/str1", name="strona1", methods={"GET"})
  */
 public function strona() {
    
    return $this->render('str1.html.twig');
} 
 /*
  *  @Route("/list", name="show_list", methods={"GET"})
  */ 
public function listAction(EntityManagerInterface $em, PaginatorInterface $paginator, Request $request)
{
    $dql   = "SELECT a FROM AppEntity:Custommer a";
    $query = $em->createQuery($dql);

    $pagination = $paginator->paginate(
        $query, /* query NOT result */
        $request->query->getInt('page', 1), /*page number*/
        10 /*limit per page*/
    );

    // parameters to template
    return $this->render('pag.html.twig', ['pagination' => $pagination]);
  

}
}