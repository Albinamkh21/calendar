<?php

namespace albinamkh\CalendarBundle\Entity;

use albinamkh\CalendarBundle\Model\EventInterface;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name: 'event')]
class Event extends EventBase implements EventInterface
{

    #[ORM\Column(name: 'source_id', type: 'integer', nullable: true)]
    private int $sourceId;

    #[ORM\Column(name: 'source_type', type: 'smallint', nullable: true)]
    private int  $sourceType;


    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getSourceId()
    {
        return $this->sourceId;
    }

    /**
     * @param mixed $sourceId
     */
    public function setSourceId($sourceId): void
    {
        $this->sourceId = $sourceId;
    }

    /**
     * @return mixed
     */
    public function getSourceType()
    {
        return $this->sourceType;
    }

    /**
     * @param mixed $sourceType
     */
    public function setSourceType($sourceType): void
    {
        $this->sourceType = $sourceType;
    }



}
