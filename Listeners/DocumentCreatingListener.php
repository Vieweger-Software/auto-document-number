<?php

namespace Modules\AutoDocumentNumber\Listeners;

use App\Events\Document\DocumentCreating;
use App\Models\Document\Document;
use App\Traits\Documents;

class DocumentCreatingListener
{

    /**
     * use the trait
     */
    use Documents;


    /**
     * Handle the event.
     *
     * @param  DocumentCreating $event
     * @return void
     */
    public function handle(DocumentCreating $event)
    {

        if(isset($event->request['document_number'])){

            $documentNumber = (int)$event->request['document_number'];

            if($documentNumber < 0 && $event->request['type'] == 'invoice'){
                $event->request['document_number'] = $this->getNextDocumentNumber(Document::INVOICE_TYPE);

            }else if($documentNumber < 0){
                $event->request['document_number'] = $this->getNextDocumentNumber(Document::BILL_TYPE);
            }

        }
    }
}
