<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Entity\User;

class UserFixtures extends Fixture{

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();

        $password = $this->encoder->encodePassword($user, 'qwerty');
        $user->setPassword($password);                     
        $user->setEmail('erufenix@gmail.com');
        $user->setRoles(['ROLE_ADMIN']);
        
        $manager->persist($user);
        $manager->flush();
    }
}
