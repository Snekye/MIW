<?php

namespace App\EventSubscriber;

use App\Entity\AdminLog;
use App\Entity\AdminUser;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class AdminSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['createLog'],
            BeforeEntityUpdatedEvent::class => ['updateLog']
        ];
    }
    private $hasher;

    public function __construct(PasswordHasherFactoryInterface $factory) 
    {
        $this->hasher = $factory->getPasswordHasher('soft');
    }

    public function createLog(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if ($entity::class === AdminUser::class) { 
            $entity = $this::hashPassword($entity); 
        }

        if (method_exists($entity::class,'setCreated')) {
            $entity = $event->getEntityInstance();

            $log = new AdminLog();
            $log->setAction('Create');
            $log->setMessage('[] à créé le <'. $entity::class.'> ['.$entity.']');

            $entity->setCreated($log);
        }
    }
    public function updateLog(BeforeEntityUpdatedEvent $event)
    {
        if ($entity::class === AdminUser::class) { 
            $entity = $this::hashPassword($entity); 
        }

        $entity = $event->getEntityInstance();
        if (method_exists($entity::class,'setUpdated')) {
            $entity = $event->getEntityInstance();

            $log = new AdminLog();
            $log->setAction('Update');
            $log->setMessage('[] à MAJ le <'. $entity::class.'> ['.$entity.']');

            $entity->setUpdated($log);
        }
    }

    public function hashPassword(AdminUser $adminUser) {
        $adminUser->setPassword($this->hasher->hash($adminUser->getPassword()));
        return $adminUser;
    }
}