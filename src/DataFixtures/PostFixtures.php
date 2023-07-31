<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PostFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * 
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $postFirst = new Post();
        $postFirst->setTitle('Ti');
        $postFirst->setReleaseDate('11112011');
        $postFirst->setDescription('This is the description');
        $postFirst->setImagePath('https://cdn.pixabay.com/photo/2013/07/18/10/59/human-skeleton-163715_1280.jpg');
        /* Make relationship between userName and post 
        $postFirst->addUserName($this->getReference('userName_first'));
        */
        $manager->persist($postFirst);

        $postSecond = new Post();
        $postSecond->setTitle('Po');
        $postSecond->setReleaseDate('13112011');
        $postSecond->setDescription('This is the best description');
        $postSecond->setImagePath('https://cdn.pixabay.com/photo/2013/07/18/10/59/human-skeleton-163715_1280.jpg');
        $manager->persist($postSecond);

        $manager->flush();
    }
}
