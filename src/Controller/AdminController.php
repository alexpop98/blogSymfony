<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Author;
use App\Form\AuthorFormType;
use App\Entity\BlogPost;
use App\Form\EntryFormType;

class AdminController extends AbstractController
{
  /**
 * @Route("/create-entry", name="admin_create_entry")
 *
 * @param Request $request
 *
 * @return \Symfony\Component\HttpFoundation\Response
 */
public function createEntryAction(Request $request)
{
    $blogPost = new BlogPost();

    $author = $this->authorRepository->findOneByUsername($this->getUser()->getUserName());
    $blogPost->setAuthor($author);

    $form = $this->createForm(EntryFormType::class, $blogPost);
    $form->handleRequest($request);

    // Check is valid
    if ($form->isSubmitted() && $form->isValid()) {
        $this->entityManager->persist($blogPost);
        $this->entityManager->flush($blogPost);

        $this->addFlash('success', 'Congratulations! Your post is created');

        return $this->redirectToRoute('admin_entries');
    }

    return $this->render('admin/entry_form.html.twig', [
        'form' => $form->createView()
    ]);
}
  private $entityManager;
  private $authorRepository;
  private $blogPostRepository;
  public function __construct(EntityManagerInterface $entityManager)
  {
      $this->entityManager = $entityManager;
      $this->blogPostRepository = $entityManager->getRepository('App:BlogPost');
      $this->authorRepository = $entityManager->getRepository('App:Author');
  }
    /**
     * @Route("/admin", name="admin")
     */
     public function createAuthorAction(Request $request)
   {

       if ($this->authorRepository->findOneByUsername($this->getUser()->getUserName())) {
           // Redirect to dashboard.
           $this->addFlash('error', 'Unable to create author, author already exists!');

           return $this->redirectToRoute('homepage');
       }

       $author = new Author();
       $author->setUsername($this->getUser()->getUserName());

       $form = $this->createForm(AuthorFormType::class, $author);
       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
           $this->entityManager->persist($author);
           $this->entityManager->flush($author);

           $request->getSession()->set('user_is_author', true);
           $this->addFlash('success', 'Congratulations! You are now an author.');

           return $this->redirectToRoute('homepage');
       }

       return $this->render('admin/create_author.html.twig', [
           'form' => $form->createView()
       ]);
   }
}
