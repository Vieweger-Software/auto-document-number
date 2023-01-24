<?php

namespace Modules\AutoDocumentNumber\Observers;

use App\Abstracts\Observer;
use App\Models\Document\Document;
use Illuminate\Support\Facades\URL;

class DocumentObserver extends Observer
{
    /**
     * Listen to the retrieved event.
     * @param  Document $document
     * @return void
     */
    public function retrieved(Document $document)
    {
        /*
        if($document->getAttribute('type') == 'invoice'){
            $document->setAttribute('document_pdf_link', URL::signedRoute('signed.invoices.pdf', [$document->company_id, $document->id]));
            $document->setAttribute('document_html_link', URL::signedRoute('signed.invoices.show', [$document->company_id, $document->id]));
            $document->setAttribute('document_print_link', URL::signedRoute('signed.invoices.print', [$document->company_id, $document->id]));
        }
        */

    }
}
