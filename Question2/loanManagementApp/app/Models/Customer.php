<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
   
   protected $fillable = [
    'name',
    'email',
    'dob',
    'phone_number',
    'id_number',
    'address',
];
public function loanApplications()
{
    return $this->hasMany(LoanApplication::class);
}
}
