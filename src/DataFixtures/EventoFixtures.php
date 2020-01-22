<?php

namespace App\DataFixtures;

use App\Entity\Evento;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class EventoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $eve = new Evento();
        $eve->setNombre('SMORLL2020');
        $eve->setSede('Morelia');
        $eve->setFecha(new \DateTime('now'));
        //$eve->setUsuario($this->getDoctrine()->getRepository(User::class)->find(1));
        $manager->persist($eve);
        $manager->flush();
    }
}
