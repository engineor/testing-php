<?php

declare(strict_types=1);

namespace App\Util\Domain;

interface NextInvoiceNumberProvider
{
    public function provide(): int;
}