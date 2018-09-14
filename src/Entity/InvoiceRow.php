<?php

declare(strict_types=1);

namespace App\Entity;

use Ramsey\Uuid\UuidInterface;

class InvoiceRow
{
    private $id;
    private $invoice;
    private $label;
    private $priceTaxExcluded;
    private $tax;

    public function __construct(UuidInterface $id, Invoice $invoice, string $label, float $priceTaxExcluded, float $tax)
    {
        $this->id = $id;
        $this->invoice = $invoice;
        $this->label = $label;
        $this->priceTaxExcluded = $priceTaxExcluded;
        $this->tax = $tax;
    }

    public function id(): string
    {
        return $this->id->toString();
    }

    public function label(): string
    {
        return $this->label;
    }

    public function priceTaxExcluded(): float
    {
        return $this->priceTaxExcluded;
    }

    public function priceTaxIncluded(): float
    {
        return $this->priceTaxExcluded + $this->tax();
    }

    public function tax(): float
    {
        return $this->tax * $this->priceTaxExcluded;
    }
}