<?php

namespace albinamkh\CalendarBundle\Controller;

use albinamkh\CalendarBundle\Entity\Event;
use albinamkh\CalendarBundle\Form\EventType;
use albinamkh\CalendarBundle\Manager\EventManager;
use albinamkh\CalendarBundle\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;


#[Route(path: '/calendar/editor', name: 'editor.')]
class EditorController extends AbstractController
{

    public function __construct(private readonly EventRepository $eventRepository, private readonly  EventManager $eventManager, private  bool $isSoftDeleteEnabled = false)
    {

    }

    #[Route(path: '/', methods: ['GET'], name: 'index')]
    public function index(): Response
    {
        $events = $this->eventManager->getAllEvents();

        return $this->render('@Calendar/editor/index.html.twig', [
            'events' => $events,
            'isSoftDeleteEnabled' => $this->isSoftDeleteEnabled,
        ]);
    }


    #[Route(path: '/new', methods: ['GET', 'POST'], name: 'new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {

        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
         ///   $data = $form->getData();
          //  $eventDTO = new EventDTO($data);
            $this->eventManager->saveEvent($event);

            return $this->redirectToRoute('editor.index');
        }

        return $this->render('@Calendar/editor/edit.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);

    }


    #[Route(path: '/{id}/edit', methods: ['GET', 'POST'], name: 'edit')]
    public function edit(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = $this->getEvent($id);

        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('editor.index');
        }

        return $this->render('@Calendar/editor/edit.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }


    #[Route(path: '/{id}/delete', name: 'delete')]
    public function delete(int $id, EntityManagerInterface $entityManager): Response
    {
        $event = $this->getEvent($id);

        if ($this->isSoftDeleteEnabled) {
            $event->setArchived(true);
        } else {
            $entityManager->remove($event);
        }

        $entityManager->flush();

        return $this->redirectToRoute('editor.index');
    }

    private function getEvent(int $id): Event
    {
        if (!$event = $this->eventRepository->findNotArchived($id)) {
            throw new NotFoundHttpException();
        }

        return $event;
    }
}
