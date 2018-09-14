<?php

declare(strict_types=1);

namespace App\Tests\Util\Infrastructure;

use App\Exception\NegativeInvoiceNumber;
use App\Util\Domain\NextInvoiceNumberProvider;
use App\Util\Infrastructure\InvoiceReferenceGenerator;
use PHPUnit\Framework\TestCase;

final class InvoiceReferenceGeneratorTest extends TestCase
{
    public function test_generate()
    {
        $generator = new InvoiceReferenceGenerator(new class implements NextInvoiceNumberProvider {
            public function provide(): int
            {
                return 1;
            }
        });

        $this->assertEquals('FA-000001', $generator->generate());
    }

    public function test_generate_string_too_long()
    {
        $generator = new InvoiceReferenceGenerator(new class implements NextInvoiceNumberProvider {
            public function provide(): int
            {
                return PHP_INT_MAX;
            }
        });

        $this->assertEquals('FA-'.PHP_INT_MAX, $generator->generate());
    }

    public function test_generate_string_with_negative()
    {
        $generator = new InvoiceReferenceGenerator(new class implements NextInvoiceNumberProvider {
            public function provide(): int
            {
                return -1;
            }
        });


        $this->expectException(NegativeInvoiceNumber::class);
        $generator->generate();
    }
}