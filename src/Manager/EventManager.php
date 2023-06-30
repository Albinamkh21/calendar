<?php

namespace albinamkh\CalendarBundle\Manager;

use albinamkh\CalendarBundle\DTO\EventDTO;
use albinamkh\CalendarBundle\Entity\Event;
use albinamkh\CalendarBundle\Model\EventInterface;
use albinamkh\CalendarBundle\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;


class EventManager
{

    private EntityManagerInterface $entityManager;
    private EventRepository $eventRepository;

    public function __construct(EntityManagerInterface $entityManager, EventRepository $eventRepository  )
    {
        $this->entityManager = $entityManager;
        $this->eventRepository = $eventRepository;
    }

    public function saveEventFromDTO(EventDTO $eventDTO): ?int
    {

        $event = new Event();
        $event->setTitle($eventDTO->getTitle());
        $event->setStartsAt($eventDTO->getStartsAt());
        $event->setEndsAt($eventDTO->getEndsAt());
        $event->setDescription($eventDTO->getDescription());
        $event->setVenueAddress($eventDTO->getVenueAddress());
        $event->setVenueName($eventDTO->getVenueName());
        $event->setArchived($eventDTO->getArchived());
        $event->setSourceId($eventDTO->getSourceId());
        $event->setSourceType($eventDTO->getSourceType());

        $this->entityManager->persist($event);
        $this->entityManager->flush();

        return $event->getId();

    }
    public function saveEvent(EventInterface $event): ?int
    {

        $this->entityManager->persist($event);
        $this->entityManager->flush();

        return $event->getId();

    }

    public function deleteEvent(int $eventId): ?int
    {

        /** @var EventRepository $eventRepository */
        $eventRepository = $this->entityManager->getRepository(Event::class);
        /** @var Event $event */
        $event = $eventRepository->find($eventId);
        if ($event === null) {
            return false;
        }
        $this->entityManager->remove($event);
        $this->entityManager->flush();

        return true;

    }
    public function deleteEventBySourceId(int $sourceId, int $sourceType): ?int
    {

        /** @var EventRepository $eventRepository */
        $eventRepository = $this->entityManager->getRepository(Event::class);
        /** @var Event $event */
        $event = $eventRepository->findOneBy(['sourceId' => $sourceId, 'sourceType' => $sourceType]);
        if ($event === null) {
            return false;
        }
        $this->entityManager->remove($event);
        $this->entityManager->flush();

        return true;

    }

    public function getAllEvents()
    {
         return $this->eventRepository->findAll();
    }
    public function getAllEventsBySources(array $sources, int $sourceType)
    {
        return $this->eventRepository->findAllBySource($sources, $sourceType);
    }




}