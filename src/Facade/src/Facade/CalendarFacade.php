<?php

namespace albinamkh\CalendarBundle\Facade;

use albinamkh\CalendarBundle\DTO\EventDTO;
use albinamkh\CalendarBundle\Manager\EventManager;

class CalendarFacade
{

    const EVENT_TYPE_LESSON =  1;
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

    public function getEventsBySources(array $sources, int $sourceType): array
    {
        return $this->eventManager->getAllEventsBySources($sources, $sourceType);

    }

}