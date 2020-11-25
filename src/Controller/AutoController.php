<?php

namespace App\Controller;
use App\Entity\Auto;
use App\Form\AutoType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\AutoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
class AutoController extends AbstractController
{
    private $autoRepository;
   private $entityManager;
    public function __construct(AutoRepository $autoRepository,EntityManagerInterface $entityManager )
    {
        $this->autoRepository = $autoRepository;
        $this->entityManager=$entityManager;
       
    }
    /**
     * @Route("/auto", name="auto1")
     */
    public function index()
    {
        return $this->render('auto/index.html.twig', [
            'controller_name' => 'AutoController',
        ]);
    }
    /**
     * @Route("/show_auto", name="auto")
     */
    public function show()
    {
        $date= $this->autoRepository->findAll();
    
        return $this->render('auto/auto.html.twig', [
            'auto' => $date,
        ]);

    }
     
    /**
     * @Route("/d_auto/{id}", name="delete")
     */
    public function delete($id)
    {   
        
        $em=$this->entityManager;
        $qb = $em->createQuery('delete  from App\Entity\Auto a where a.id = :mar')
        ->setParameter('mar', $id);
        
        $ss=$qb->execute();        

        if($ss==0)
        {
        return $this->render('auto/auto3.html.twig', [
            'auto' => $ss,
        ]);
        }
        else
        { 
          return $this->redirectToRoute('auto');  
        }
    }
    /**
     * @Route("/pok_auto/{id}", name="auto1")
     */
    public function show1($id)
    {
        $date= $this->autoRepository->find($id);
    
        return $this->render('auto/auto1.html.twig', [
            'auto' => $date,
        ]);

    }
     /**
     * @Route("/edycja_auto/{id}", name="auto5")
     */
     public function edycja($id , Request $request)
    {
        
    
        $data= $this->entityManager->find('App\Entity\Auto',$id);
         $aut =new Auto();
         $j=$data->getColor();
         
        $aut->setColor($j);
       $aut->setMarka($data->getMarka());
        $aut->setRok_prod($data->getRokprod());
        $form= $this->createForm(AutoType::class, $aut );
         $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitte values
        // but, the original `$task` variable has also been updated
        $aut = $form->getData();
        $aut->setId($id);
        $color=$aut->getColor();
        $dat=$aut->getRokprod();
        $marka=$aut->getMarka();
        $em= $this->getDoctrine()->getManager();
       $qb = $em->createQuery('update App\Entity\Auto as a   set a.color =:color ,a.marka =:marka ,a.rok_prod =:rok where a.id = :mar')
        ->setParameter('mar', $id)
       ->setParameter('color', $color)
       ->setParameter('marka', $marka)
       ->setParameter('rok', $dat);
        
        $qb->execute();
        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!
        
       // $entityManager->persist($aut);
        // $entityManager->flush();   
     return $this->redirectToRoute('auto');
         }
        return $this->render('auto/auro5.html.twig', [
            'auto' => $form->createView(),
        ]);
         
    }
    /**
     * @Route("/new_auto", name="new_auto")
     */
    public function addAuto(Request $request)
    {
        $aut =new Auto();
        $aut->setColor('brąż');
        $form= $this->createForm(AutoType::class, $aut );
        $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitte values
        // but, the original `$task` variable has also been updated
        $aut = $form->getData();

        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($aut);
         $entityManager->flush();

        return $this->redirectToRoute('auto');
    }
   
    return $this->render('auto/auto_new.html.twig', [
        'form' =>$form->createView(),]);
    }
    

    }
