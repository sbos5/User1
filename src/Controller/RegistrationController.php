<?php
declare(strict_types=1);
namespace App\Controller;
use App\Entity\User;
use App\Form\UserType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, Session $session)
    {
        $form = $this->createForm(UserType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = new User($form->get('username')->getData(), $form->get('email')->getData());
            $password = $passwordEncoder->encodePassword($user, $form->get('password')->getData());
            $user->setPassword($password);
            $user->setUsername($form->get('username')->getData());
            $user->setEmail($form->get('email')->getData());
            try {
                $entityManager->persist($user);
                $entityManager->flush();
                $session->getFlashBag()->add('success', sprintf('Account %s has been created!', $user->getUsername()));
                return $this->redirectToRoute('login');
            } catch (UniqueConstraintViolationException $exception) {
               // $session->getFlashBag()->add('danger', 'Email and username has to be unique');
            }
        }
        return $this->render('User/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
