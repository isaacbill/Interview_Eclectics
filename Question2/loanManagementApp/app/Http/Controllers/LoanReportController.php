<?php

namespace App\Http\Controllers;
use App\Models\LoanApplication;

use Illuminate\Http\Request;

class LoanReportController extends Controller
{
    public function index()
    {
        // Fetch all loan applications with related customer and loan product data
        $loanApplications = LoanApplication::with(['customer', 'loanProduct'])->get();
    
        // Perform calculations
        foreach ($loanApplications as $loanApplication) {
            if ($loanApplication->status === 'approved') {
                // If the loan is approved, set amount disbursed
                $loanApplication->amount_disbursed = $loanApplication->requested_amount;
            }
    
            if ($loanApplication->status === 'repaid') {
                // If the loan is repaid, adjust the balance
                $loanApplication->balance = $loanApplication->requested_amount - $loanApplication->amount_repaid;
            } else {
                // Calculate the balance for other statuses
                $loanApplication->balance = $loanApplication->amount_disbursed - ($loanApplication->amount_repaid ?? 0);
            }
        }
    
        // Return the report view
        return view('report.report', compact('loanApplications'));
    }
    
}
