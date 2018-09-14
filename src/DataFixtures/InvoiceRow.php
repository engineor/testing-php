<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\InvoiceRow as InvoiceRowEntity;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

final class InvoiceRow extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $invoiceRow = new InvoiceRowEntity(
            Uuid::fromString('fb406aad-593c-4bc0-8b4d-bba56a710e25'),
            $this->getReference(Invoice::INVOICE),
            'First product',
            100,
            0.2
        );
        $manager->persist($invoiceRow);

        $numberOfRows = rand(1, 10);
        for ($i = 0; $i < $numberOfRows; $i++) {
            $invoiceRow = new InvoiceRowEntity(
                Uuid::uuid4(),
                $this->getReference(Invoice::INVOICE),
                'Product '. ($i + 1),
                rand(1, 100),
                0.2
            );

            $manager->persist($invoiceRow);
        }
        $manager->flush();

    }
}