<?php

namespace albinamkh\CalendarBundle\Controller;

use albinamkh\CalendarBundle\Entity\Event;
use albinamkh\CalendarBundle\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;


#[Route(path: '/calendar/event', name: 'event.')]
class EventController extends AbstractController
{
    /** @var EventRepository */
    private $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    #[Route(path: '/{id}', methods: ['GET'], name: 'show')]
    public function show(int $id): Response
    {
        $event = $this->getEvent($id);

        return $this->render('@Calendar/show.html.twig', [
            'event' => $event,

        ]);
    }


    private function getEvent(int $id): Event
    {
        if (!$event = $this->eventRepository->findNotArchived($id)) {
            throw new NotFoundHttpException();
        }

        return $event;
    }
}
