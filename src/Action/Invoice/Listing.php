<?php

declare(strict_types=1);

namespace App\Action\Invoice;

use App\Repository\Domain\Invoice as InvoiceRepository;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment as Renderer;

final class Listing
{
    private $renderer;

    private $invoiceRepository;

    public function __construct(Renderer $renderer, InvoiceRepository $invoiceRepository)
    {
        $this->renderer = $renderer;
        $this->invoiceRepository = $invoiceRepository;
    }

    /**
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function handle(): Response
    {
        return new Response($this->renderer->render('invoice/listing.html.twig', [
            'invoices' => $this->invoiceRepository->fetchAll(),
        ]));
    }
}