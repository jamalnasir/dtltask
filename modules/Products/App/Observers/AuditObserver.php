<?php

namespace Modules\Products\App\Observers;

use Auth;
use Modules\Products\App\Models\Audit;

class AuditObserver
{
    /**
     * Handle the Audit "creating" event.
     */
    public function creating(Audit $audit) : void
    {
        $audit->updated_by = Auth::user()->id;
    }
}