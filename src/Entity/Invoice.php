<?php

declare(strict_types=1);

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\UuidInterface;

class Invoice
{
    private $id;
    private $date;
    private $recipient;
    private $reference;
    private $rows;

    public function __construct(UuidInterface $id, string $reference, DateTimeInterface $date)
    {
        $this->id = $id;
        $this->reference = $reference;
        $this->date = $date;
        $this->rows = new ArrayCollection();
    }

    public function id(): string
    {
        return $this->id->toString();
    }

    public function date(): DateTimeInterface
    {
        return $this->date;
    }

    public function reference(): string
    {
        return $this->reference;
    }

    public function rows(): array
    {
        return $this->rows->toArray();
    }
}