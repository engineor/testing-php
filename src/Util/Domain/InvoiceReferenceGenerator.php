<?php

declare(strict_types=1);

namespace App\Util\Domain;

interface InvoiceReferenceGenerator
{
    public function generate(): string;
}