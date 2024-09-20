<?php

// app/Http/Controllers/LoanApplicationController.php
namespace App\Http\Controllers;

use App\Models\LoanApplication;
use App\Models\LoanProduct;
use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LoanApplicationController extends Controller
{
    public function index(Request $request)
{
    if ($request->ajax()) {
        $loanApplications = LoanApplication::with(['customer', 'loanProduct'])->get();

        return DataTables::of($loanApplications)
            ->addColumn('action', function ($loanApplication) {
                return '
                    <a href="'.route('loan_applications.approve', $loanApplication->id).'" class="btn btn-success btn-sm">Approve</a>
                    <a href="'.route('loan_applications.repay', $loanApplication->id).'" class="btn btn-warning btn-sm">Repay</a>
                ';
            })
            ->make(true);
    }

    return view('loan_applications.index');
}

    public function create()
    {
        $loanProducts = LoanProduct::all();
        $customers = Customer::all();
        return view('loan_applications.create', compact('loanProducts', 'customers'));
    }

    public function store(Request $request)
{
    $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'loan_product_id' => 'required|exists:loan_products,id',
        'requested_amount' => 'required|numeric|min:0', // This should match your form
    ]);

    LoanApplication::create([
        'customer_id' => $request->customer_id,
        'loan_product_id' => $request->loan_product_id,
        'requested_amount' => $request->requested_amount, // Ensure this is included
        'status' => 'pending', // Set default status if necessary
    ]);

    return redirect()->route('loan_applications.index')->with('success', 'Loan application created successfully.');
}

public function approve($id)
{
    $loanApplication = LoanApplication::findOrFail($id);
    $loanApplication->status = 'approved';
    $loanApplication->disbursed_at = now();
    $loanApplication->save();

    return redirect()->route('loan_applications.index')->with('success', 'Loan application approved successfully.');
}

public function repay($id)
{
    $loanApplication = LoanApplication::findOrFail($id);
    $loanApplication->status = 'repaid';
    $loanApplication->repaid_at = now();
    $loanApplication->save();

    return redirect()->route('loan_applications.index')->with('success', 'Loan application marked as repaid.');
}
    public function show($id)
{
    // Find the loan application by its ID, or fail if not found
    $loanApplication = LoanApplication::with(['customer', 'loanProduct'])->findOrFail($id);
    
    // Return a view with the loan application data
    return view('loan_applications.show', compact('loanApplication'));
}
    public function report()
    {
 
      $loanApplications = LoanApplication::with(['customer', 'loanProduct'])
        ->paginate(10); // You can paginate or retrieve all
    
    return view('loan_applications.report', compact('loanApplications'));
    }
}


