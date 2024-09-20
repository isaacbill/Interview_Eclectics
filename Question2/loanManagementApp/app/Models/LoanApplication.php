<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanApplication extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'customer_id',
        'loan_product_id',
        'requested_amount',
        'amount_disbursed', 
        'amount_repaid',    
        'status',
        'disbursed_at',
        'repaid_at'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function loanProduct()
    {
        return $this->belongsTo(LoanProduct::class);
    }
}
