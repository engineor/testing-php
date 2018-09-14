<?php

declare(strict_types=1);

namespace App\Repository\Domain;

use Ramsey\Uuid\UuidInterface;

interface Invoice
{
    /**
     * @return Invoice[]
     */
    public function fetchAll(): array;

    public function find(UuidInterface $id);

    public function count(): int;
}