<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
  /** @var EntityManagerInterface */
private $entityManager;

/** @var \Doctrine\Common\Persistence\ObjectRepository */
private $authorRepository;

/** @var \Doctrine\Common\Persistence\ObjectRepository */
private $blogPostRepository;

/**
 * @param EntityManagerInterface $entityManager
 */
public function __construct(EntityManagerInterface $entityManager)
{
    $this->entityManager = $entityManager;
    $this->blogPostRepository = $entityManager->getRepository('App:BlogPost');
    $this->authorRepository = $entityManager->getRepository('App:Author');
}
    /**
     * @Route("/blog", name="blog")
     */
     public function entriesAction()
     {
         return $this->render('blog/entries.html.twig', [
             'blogPosts' => $this->blogPostRepository->findAll()
         ]);
     }
}
