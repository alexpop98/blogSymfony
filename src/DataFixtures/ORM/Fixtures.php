<?php

namespace App\DataFixtures\ORM;

use App\Entity\Author;
use App\Entity\BlogPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Fixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $author = new Author();
        $author
            ->setNome('alex')
            ->setCognome('pop')
            ->setEmail('alepop@gmail.com')
            ->setPassword('password')
            ->setRuolo('amministratore');

        $manager->persist($author);

        $blogPost = new BlogPost();
        $blogPost
            ->setTitolo('Primo post')
            ->setSottotitolo('sottotitolo primo post')
            ->setTesto('testo inutile del primo post')
            ->setIdAutore('1');
        $manager->persist($blogPost);
        $manager->flush();
    }
}
