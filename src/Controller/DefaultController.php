<?php

namespace App\Controller;

use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\{SubmitType, TextareaType, TextType};
use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig');
    }

    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('default/about.html.twig');
    }

    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        # Add form fields
        $form = $this->createFormBuilder($contact)
            ->add('name', TextType::class, array('label'=> 'Your Name', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('email', TextType::class, array('label'=> 'Your Email','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('subject', TextType::class, array('label'=> 'Subject','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('message', TextareaType::class, array('label'=> 'Message','attr' => array('class' => 'form-control')))
            ->add('Save', SubmitType::class, array('label'=> 'Contact Us', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-top:15px')))
            ->getForm();
        # Handle form response
        $form->handleRequest($request);

        if($form->isSubmitted() &&  $form->isValid()) {
            $name = $form['name']->getData();
            $email = $form['email']->getData();
            $subject = $form['subject']->getData();
            $message = $form['message']->getData();

            $objemail = (new Email())
                ->from('webmaster@zionsharp.online')
                ->to($email)
                ->replyTo('webmaster@zionsharp.online')
                ->subject('Thank you for contacting ZHO')
                ->text('We have received your message and will respond soon!')
                ->html('<p>We have received your message and will respond soon!</p>');

            $mailer->send($objemail);

            $objemail = (new Email())
                ->from($email)
                ->to('webmaster@zionsharp.online')
                ->replyTo($email)
                ->subject('New message from ZHO contact page')
                ->html(<<<EOF
<table>
    <tr>
        <td>Name</td><td>$name</td>
    </tr>
    <tr>
        <td>Subject</td><td>$subject</td>
    </tr>
    <tr>
        <td>Message</td><td>$message</td>
    </tr>
</table>
EOF
);

            $mailer->send($objemail);

            return $this->render('default/index.html.twig');
        }

        return $this->render('default/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/privacy-policy', name: 'app_privacy')]
    public function privacy(): Response
    {
        return $this->render('default/privacy.html.twig');
    }

    #[Route('/terms-of-use', name: 'app_terms')]
    public function terms(): Response
    {
        return $this->render('default/terms.html.twig');
    }
}
