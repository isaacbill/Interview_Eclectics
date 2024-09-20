<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanProduct extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'code',
        'minimum_amount',
        'maximum_amount',
        'interest_rate',
        'currency',
    ];

    public function loanApplications()
{
    return $this->hasMany(LoanApplication::class);
}

}
