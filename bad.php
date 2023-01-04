<?php

/**
 * Please, improve this class and fix all problems.
 *
 * You can change the Tenant class and its methods and properties as you want.
 * You can't change the AccountingService behavior.
 * You can choose PHP 7 or 8.
 * You can consider this class as an Eloquent model, so you are free to use
 * any Laravel methods and helpers.
 *
 * What is important:
 * - design (extensibility, testability)
 * - code cleanliness, following best practices
 * - consistency
 * - naming
 * - formatting
 *
 * Write your perfect code!
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\AccountingService;

class Tenant extends Model{
    private $accountingService;

    function __construct(AccountingService $accountingService){
        $this->accountingService = $accountingService;
    }

    public function get_invoices(): array {
        $params = array('tenant_id' => $this->id);
        return collect($this->accountingService->getAllInvoices($params))->where('status', 'awaiting-payment')->all();
    }

    public function get_old_invoices(): array {
        $params = array('tenant_id' => $this->id);
        return collect($this->accountingService->getAllInvoices($params))->where('status', 'paid')->all();
    }
}
