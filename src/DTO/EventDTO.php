<?php

namespace albinamkh\CalendarBundle\DTO;

use DateTime;

class EventDTO
{
    private ?int $id;


    #[Assert\Length(min: 3, max: 255,
        minMessage: 'Название должно быть не менее 3х символов',)]
    public string $title;

    #[Assert\NotBlank]
    public string $description;

    #[Assert\NotBlank]
    private DateTime $startsAt;

    private ?DateTime $endsAt;

    #[Assert\Length(min: 3, max: 255, minMessage: 'Адрес не должен быть менее 3х символов',)]
    private $venueAddress;


    #[Assert\Length(min: 3, max: 255, minMessage: 'Адрес не должен быть менее 3х символов',)]
    private $venueName;

     private $archived;

     private ?int $sourceId;
     private ?int $sourceType;



    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->title = $data['title'] ?? '';
        $this->description = $data['description'] ?? '';

        $this->venueAddress = $data['venueAddress'] ?? '';
        $this->venueName = $data['venueName'] ?? '';
        $this->archived = $data['archived'] ?? false;
        $this->startsAt = $data['startsAt'] ?? null;
        $this->endsAt = $data['endsAt'] ?? null;
        $this->sourceId = $data['sourceId'] ?? null;
        $this->sourceType = $data['sourceType'] ?? null;
    }


    public function getId(): ?int
    {
        return $this->id;
    }
    public function getTitle(): string
    {
        return $this->title;
    }


    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return DateTime
     */
    public function getStartsAt(): DateTime
    {
        return $this->startsAt;
    }

    /**
     * @return DateTime|null
     */
    public function getEndsAt(): ?DateTime
    {
        return $this->endsAt;
    }

    /**
     * @return mixed|string
     */
    public function getVenueAddress(): mixed
    {
        return $this->venueAddress;
    }

    /**
     * @return mixed|string
     */
    public function getVenueName(): mixed
    {
        return $this->venueName;
    }

    /**
     * @return false|mixed
     */
    public function getArchived(): mixed
    {
        return $this->archived;
    }

    /**
     * @return int
     */
    public function getSourceId(): ?int
    {
        return $this->sourceId;
    }

    /**
     * @return int
     */
    public function getSourceType(): ?int
    {
        return $this->sourceType;
    }




    public function toArray() : array
    {
        return
            [
                'id' => $this->id,
                'title' => $this->title,
                'description' => $this->description,

            ]
            ;
    }

}