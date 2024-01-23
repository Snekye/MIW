<?php

namespace App\EventSubscriber;

use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityDeletedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\Persistence\ObjectManager;

use App\Entity\AdminLog;
use App\Entity\AdminUser;

class AdminSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => ['createLog'],
            BeforeEntityUpdatedEvent::class => ['updateLog'],
            BeforeEntityDeletedEvent::class => ['deleteLog']
        ];
    }
    private $hasher;
    private $tokenStorage;
    private $manager;

    public function __construct(PasswordHasherFactoryInterface $factory, TokenStorageInterface $tokenStorage, ObjectManager $manager) 
    {
        $this->hasher = $factory->getPasswordHasher('soft');
        $this->tokenStorage = $tokenStorage;
        $this->manager = $manager;
    }

    public function createLog(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if ($entity::class === AdminUser::class) { 
            $entity = $this::hashPassword($entity); 
        }

        if (method_exists($entity::class,'setCreated')) {
            $user = $this->tokenStorage->getToken()->getUser();

            $log = new AdminLog();
            $log->setAction('Create');
            $log->setUserLogin($user);
            $log->setMessage('['.$user->getLogin().'] à créé le <'. $entity::class.'> ['.$entity.']');

            $entity->setCreated($log);
        }
    }
    public function updateLog(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();
        
        if ($entity::class === AdminUser::class) { 
            $entity = $this::hashPassword($entity); 
        }

        $entity = $event->getEntityInstance();
        if (method_exists($entity::class,'setUpdated')) 
        {
            $user = $this->tokenStorage->getToken()->getUser();

            $log = new AdminLog();
            $log->setAction('Update');
            $log->setUserLogin($user);
            $log->setMessage('['.$user->getLogin().'] à MAJ le <'. $entity::class.'> ['.$entity.']');

            $entity->setUpdated($log);
        }
    }
    public function deleteLog(BeforeEntityDeletedEvent $event)
    {
        $entity = $event->getEntityInstance();
        $user = $this->tokenStorage->getToken()->getUser();

        $log = new AdminLog();
        $log->setAction('Delete');
        $log->setUserLogin($user);
        $log->setMessage('['.$user->getLogin().'] à supprimé le <'. $entity::class.'> ['.$entity.']');

        $this->manager->persist($log);
    }

    public function hashPassword(AdminUser $adminUser) {
        $adminUser->setPassword($this->hasher->hash($adminUser->getPassword()));
        return $adminUser;
    }
}