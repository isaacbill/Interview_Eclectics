<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_application_id',
        'disbursed_amount',
        'disbursement_date',
        'repayment_amount',
        'repayment_date',
    ];

    public function loanApplication()
    {
        return $this->belongsTo(LoanApplication::class);
    }
}

