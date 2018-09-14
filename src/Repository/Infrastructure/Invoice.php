<?php

declare(strict_types=1);

namespace App\Repository\Infrastructure;

use App\Repository\Domain\Invoice as InvoiceRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

final class Invoice implements InvoiceRepositoryInterface
{
    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(\App\Entity\Invoice::class);
    }

    /**
     * @return \App\Entity\Invoice[]
     */
    public function fetchAll(): array
    {
        return $this->repository->findAll();
    }

    public function find(UuidInterface $id)
    {
        return $this->repository->find($id);
    }

    public function count(): int
    {
        return count($this->fetchAll());
    }
}