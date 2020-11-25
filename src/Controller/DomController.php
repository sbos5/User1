<?php

namespace App\Controller;
use App\Entity\Dom;
use App\Form\DomType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\DomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DomController extends AbstractController
{ 
    private $domRepository;

    public function __construct(DomRepository $domRepository)
    {
        $this->domRepository = $domRepository;
    }
    /**
     * @Route("/dom", name="dom")
     */
    public function index()
    {
        return $this->render('dom/index.html.twig', [
            'controller_name' => 'DomController',
        ]);
    }
     /**
     * @Route("/domy", name="domy")
     */
    public function showDomy()
    {
        $data=$this->domRepository->findAll();
        
       // $data->getId();
         //$data->getModel();
          //$data->getData();
           
        return $this->render('dom/index.html.twig', [
            'dom' => $data,
        ]);
    } 
     /**
     * @Route("/new_dom", name="new_dom" )
     */
    public function addDom(Request $request)
 { 
     $dom=new Dom();
      

    $form = $this->createForm(DomType::class,$dom);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $dom = $form->getData();

        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($dom);
         $entityManager->flush();

        return $this->redirectToRoute('domy');
    }
   
    return $this->render('dom/dom_new.html.twig', [
        'form' => $form->createView(),
    ]);
       
}
}
