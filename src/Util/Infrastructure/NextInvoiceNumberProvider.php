<?php

declare(strict_types=1);

namespace App\Util\Infrastructure;

use App\Repository\Domain\Invoice;
use App\Util\Domain\NextInvoiceNumberProvider as NextInvoiceNumberProviderInterface;

final class NextInvoiceNumberProvider implements NextInvoiceNumberProviderInterface
{
    private $invoiceRepository;

    public function __construct(Invoice $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function provide(): int
    {
        return $this->invoiceRepository->count() + 1;
    }
}