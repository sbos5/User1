<?php
namespace App\Controller;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
 //use Symfony\Component\Routing\Annotation\Route;
/** 
 * Class LoginController
 * @package App\Controller
 */
class LoginController extends AbstractController {
    
      private $userRepository;
      private $entityManager;
     public function __construct(UserRepository $userRepository,EntityManagerInterface $entityManager )
    {
        $this->userRepository = $userRepository;
        $this->entityManager=$entityManager;
    }
  /**
   * @Route("/login", name="login")
   */
 /* public function login(Request $request, AuthenticationUtils $authenticationUtils, 
          UserPasswordEncoderInterface $passwordEncoder) : Response 
  {
      $user=new User();
    $errors = $authenticationUtils->getLastAuthenticationError();
    $lastUsername = $authenticationUtils->getLastUsername();*/
    public function login(Request $request, 
          UserPasswordEncoderInterface $passwordEncoder) : Response 
  {
      $user=new User();
     //$form = $this->createForm(UserType::class , $user);
           // ->add('username', TextType::class)
            //->add('password', TextType::class);
      
    $defaultData = ['message' => 'Formularz logowania'];
    $form = $this->createFormBuilder($defaultData)
        ->add('_username')
        ->add('_password', TextType::class)    
         ->add('zaloguj', SubmitType::class)
        ->getForm();
          
            
        $form->handleRequest($request);
         if($form->isSubmitted() && $form->isValid())
        {
             $hasło=$form->getData()->getPassword();
            (string) $login=$form->getData()->getUsername();
             $date= $this->userRepository->findOneBy([username=>'jan']);
            (String) $log=$date->getUsername();
              $has=$date->getPassword();
             // $has = $passwordEncoder->encodePassword($user,$has);
            
             if($hasło==$has && $log==$login)
             { return $this->redirectToRoute('login1'); }
             else
              { return $this->redirectToRoute('registration'); }   
             
         }
    return $this->render('User/login.html.twig', [
     // 'errors' => $errors,
     // 'username' => $lastUsername,
         
      'form' => $form->createView()  
    ]);
  }
  /**
   * @Route("/logout", name="logout")
   */
  public function logout() : Response {}
}


