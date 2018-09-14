<?php

declare(strict_types=1);

namespace App\Util\Infrastructure;

use App\Exception\NegativeInvoiceNumber;
use App\Util\Domain\InvoiceReferenceGenerator as InvoiceReferenceGeneratorInterface;
use App\Util\Domain\NextInvoiceNumberProvider;

final class InvoiceReferenceGenerator implements InvoiceReferenceGeneratorInterface
{
    /**
     * @var NextInvoiceNumberProvider
     */
    private $invoiceNumberProvider;

    public function __construct(NextInvoiceNumberProvider $invoiceNumberProvider)
    {
        $this->invoiceNumberProvider = $invoiceNumberProvider;
    }

    public function generate(): string
    {
        $number = $this->invoiceNumberProvider->provide();
        if ($number < 0) {
            throw new NegativeInvoiceNumber($number);
        }
        $number = (string) $number;

        return $this->generateLong($number);
        return $this->generateShort($number);
    }

    private function generateShort(string $number): string
    {
        return sprintf(
            'FA-%s',
            substr(str_pad(
                $number,
                6,
                '0',
                STR_PAD_LEFT
            ),0, 6)
        );
    }

    private function generateLong(string $number): string
    {
        return sprintf(
            'FA-%s',
            str_pad(
                $number,
                6,
                '0',
                STR_PAD_LEFT
            )
        );
    }
}