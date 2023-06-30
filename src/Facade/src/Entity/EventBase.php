<?php

namespace albinamkh\CalendarBundle\Entity;

use albinamkh\CalendarBundle\Model\EventInterface;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;


#[MappedSuperclass]
class EventBase implements EventInterface
{

    const EVENT_SOURCE_TYPE = 1;
    #[ORM\Column(name: 'id', type: 'bigint', unique: true)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private $title;

    #[ORM\Column(name: 'starts_at', type: 'datetime', nullable: false)]
    private DateTime $startsAt;


    #[ORM\Column(name: 'ends_at', type: 'datetime', nullable: true)]
    private ?DateTime $endsAt;


    #[ORM\Column(type: 'text', nullable: true)]
    private $description;


    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $venueAddress;


    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $venueName;

    #[ORM\Column(type: 'boolean')]
    private $archived;



    public function __construct()
    {
        $this->archived = false;
        $this->startsAt = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getStartsAt(): DateTimeInterface
    {
        return $this->startsAt;
    }

    public function setStartsAt(DateTimeInterface $startsAt): self
    {
        $this->startsAt = $startsAt;

        return $this;
    }

    public function getEndsAt(): ?DateTimeInterface
    {
        return $this->endsAt;
    }

    public function setEndsAt(?DateTimeInterface $endsAt): self
    {
        $this->endsAt = $endsAt;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVenueAddress()
    {
        return $this->venueAddress;
    }

    /**
     * @param mixed $venueAddress
     * @return static
     */
    public function setVenueAddress($venueAddress): self
    {
        $this->venueAddress = $venueAddress;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVenueName()
    {
        return $this->venueName;
    }

    /**
     * @param mixed $venueName
     * @return static
     */
    public function setVenueName($venueName): self
    {
        $this->venueName = $venueName;
        return $this;
    }

    public function isArchived(): ?bool
    {
        return $this->archived;
    }

    public function setArchived(bool $archived): self
    {
        $this->archived = $archived;

        return $this;
    }

}