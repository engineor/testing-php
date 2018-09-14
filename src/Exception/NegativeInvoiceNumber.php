<?php

declare(strict_types=1);

namespace App\Exception;

use LogicException;

final class NegativeInvoiceNumber extends LogicException
{
    public function __construct(int $number)
    {
        parent::__construct("{$number} is not a valid value for invoice as it's negative");
    }
}