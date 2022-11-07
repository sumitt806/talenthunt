<?php

namespace App\Queries;

use App\Models\Transaction;

/**
 * Class TransactionDataTable
 */
class TransactionDataTable
{
    /**
     * @return Transaction
     */
    public function get()
    {
        $query = Transaction::with(['type', 'user'])->get();

        return $query;
    }
}
