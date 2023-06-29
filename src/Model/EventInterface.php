<?php

namespace albinamkh\CalendarBundle\Model;

use DateTime;
use DateTimeInterface;

interface EventInterface
{

   // public function createEvent();
    public function getId();

    public function getTitle();

    public function setTitle(string $title);

    public function getStartsAt();

    public function setStartsAt(DateTimeInterface $startsAt);
    public function getEndsAt();

    public function setEndsAt(?DateTimeInterface $endsAt);

    public function getDescription();

    public function setDescription(?string $description);

    /**
     * @return mixed
     */
    public function getVenueAddress();

    /**
     * @param mixed $venueAddress
     * @return static
     */
    public function setVenueAddress($venueAddress);

    /**
     * @return mixed
     */
    public function getVenueName();

    /**
     * @param mixed $venueName
     * @return static
     */
    public function setVenueName($venueName);

    public function isArchived();

    public function setArchived(bool $archived);

}