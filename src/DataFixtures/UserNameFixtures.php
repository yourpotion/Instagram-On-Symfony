<?php

namespace App\DataFixtures;

use App\Entity\UserName;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserNameFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * 
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $userNameFirst = new UserName();
        $userNameFirst->setName('Ti');
        $manager->persist($userNameFirst);

        $userNameSecond = new UserName();
        $userNameSecond->setName('Po');
        $manager->persist($userNameSecond);

        $userNameThird = new UserName();
        $userNameThird->setName('Tipo');
        $manager->persist($userNameThird);

        $userNameFourth = new UserName();
        $userNameFourth->setName('Poti');
        $manager->persist($userNameFourth);

        $manager->flush();

        /* Make relationship between userName and post 
        $this->addReference('userName_first', $userNameFirst);
        $this->addReference('userName_second', $userNameSecond);
        $this->addReference('userName_third', $userNameThird);
        $this->addReference('userName_fourth', $userNameFourth);*/

    }
}
