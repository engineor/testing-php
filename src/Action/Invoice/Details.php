<?php

declare(strict_types=1);

namespace App\Action\Invoice;

use App\Repository\Domain\Invoice as InvoiceRepository;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Twig\Environment as Renderer;

final class Details
{
    private $renderer;

    private $invoiceRepository;

    private const ERROR_MESSAGE = 'No invoice with the given id has been found in our system.';

    public function __construct(Renderer $renderer, InvoiceRepository $invoiceRepository)
    {
        $this->renderer = $renderer;
        $this->invoiceRepository = $invoiceRepository;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function handle(Request $request): Response
    {
        if (! $request->attributes->get('id')) {
            throw new NotFoundHttpException(self::ERROR_MESSAGE);
        }

        $invoice = $this->invoiceRepository->find(Uuid::fromString($request->attributes->get('id')));
        if (! $invoice) {
            throw new NotFoundHttpException(self::ERROR_MESSAGE);
        }

        return new Response($this->renderer->render('invoice/details.html.twig', [
            'invoice' => $invoice,
        ]));
    }
}