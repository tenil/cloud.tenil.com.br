<?php

/**
 * @author Roberto
 */

namespace TenilUser\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use TenilUser\Entity\User;

class LoadUser extends AbstractFixture {

    public function load(ObjectManager $manager) {
        $user = new User();
        $user->setNome('Roberto')
                ->setEmail('roberto.tenil@gmail.com')
                ->setPassword(123456)
                ->setActive(TRUE);

        $manager->persist($user);
        $manager->flush();
    }

}