<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\TipoConta;
use App\Entity\Gerente;
use App\Entity\Agencia;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $hasher
    ){}

    public function load(ObjectManager $manager): void
    {
        $user1 = new User(); 
        $user1->setEmail('admin@gmail.com');
        $user1->setRoles(['ROLE_ADMIN']);
        $user1->setPassword(
            $this->hasher->hashPassword($user1, '123456')
        );
        $user1->setIsVerified(true);
        $user1->setNome('Ricardo Dev');
        $user1->setCpf('457.983.600-67');
        $user1->setCelular('83922223333');
        $manager->persist($user1);

        $user2 = new User(); 
        $user2->setEmail('gerente@gmail.com');
        $user2->setRoles(['ROLE_GERENTE']);
        $user2->setPassword(
            $this->hasher->hashPassword($user2, '123456')
        );
        $user2->setIsVerified(true);
        $user2->setNome('Renan Dev');
        $user2->setCpf('457.983.600-67');
        $user2->setCelular('83922223333');
        $manager->persist($user2);

        $user3 = new User(); 
        $user3->setEmail('cliente@gmail.com');
        $user3->setRoles(['ROLE_CLIENTE']);
        $user3->setPassword(
            $this->hasher->hashPassword($user2, '123456')
        );
        $user3->setIsVerified(true);
        $user3->setNome('Ayla Dev');
        $user3->setCpf('457.983.600-67');
        $user3->setCelular('83922223333');
        $manager->persist($user3);

        $tipo1 = new TipoConta();
        $tipo1->setTipo('CC');
        $manager->persist($tipo1);

        $tipo2 = new TipoConta();
        $tipo2->setTipo('CP');
        $manager->persist($tipo2);

        $gerente1 = new Gerente();
        $gerente1->setNome('Renan Dev');
        $gerente1->setUser($user2);
        $manager->persist($gerente1);

        $agencia1 = new Agencia();
        $agencia1->setGerente($gerente1);
        $agencia1->setCodigo('001');
        $agencia1->setTelefone('83322223333');
        $agencia1->setCidade('São Paulo');
        $agencia1->setRua('Rua Principal');
        $agencia1->setCep('58333-000');
        $agencia1->setBairro('Centro');
        $agencia1->setNumero('222');
        $agencia1->setEstado('SP');
        $manager->persist($agencia1);

        $manager->flush();
    }
}
