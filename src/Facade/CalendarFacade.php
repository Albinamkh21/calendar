<?php

namespace albinamkh\CalendarBundle\Facade;

use albinamkh\CalendarBundle\DTO\EventDTO;
use albinamkh\CalendarBundle\Manager\EventManager;

class CalendarFacade
{
    public function __construct(private readonly EventManager $eventManager)
    {
    }

    public function addEvent(array $data): ?int
    {
        $eventDTO = new EventDTO($data);
        return $this->eventManager->saveEventFromDTO($eventDTO);
    }

    public function deleteEventBySourceId(int $sourceId, int $sourceType): bool
    {
        return $this->eventManager->deleteEventBySourceId($sourceId, $sourceType);

    }

}