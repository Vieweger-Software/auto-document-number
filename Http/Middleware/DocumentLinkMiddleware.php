<?php

namespace Modules\AutoDocumentNumber\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class DocumentLinkMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $response = $next($request);

        if($response instanceof JsonResponse) {

            $responseData = $response->getData();
            $responseData->data->document_pdf_link = URL::signedRoute('signed.invoices.pdf', [$responseData->data->company_id, $responseData->data->id]);
            $responseData->data->document_html_link = URL::signedRoute('signed.invoices.show', [$responseData->data->company_id, $responseData->data->id]);
            $responseData->data->document_print_link = URL::signedRoute('signed.invoices.print', [$responseData->data->company_id, $responseData->data->id]);
            $response->setData($responseData);
        }

        return $response;
    }
}
