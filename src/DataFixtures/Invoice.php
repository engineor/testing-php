<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Invoice as InvoiceEntity;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

final class Invoice extends Fixture
{
    public const INVOICE = 'invoice';

    public function load(ObjectManager $manager)
    {
        $invoice = new InvoiceEntity(
            Uuid::fromString('fb406aad-593c-4bc0-8b4d-bba56a710e24'),
            'FA-000001',
            new DateTimeImmutable('April 21, 1944 12:00',new \DateTimeZone('UTC'))
        );

        $manager->persist($invoice);
        $manager->flush();

        $this->addReference(self::INVOICE, $invoice);
    }
}