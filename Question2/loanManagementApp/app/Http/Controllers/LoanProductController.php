<?php

namespace App\Http\Controllers;

use App\Models\LoanProduct;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LoanProductController extends Controller
{
    // List all loan products
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = LoanProduct::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $editUrl = route('loan-products.edit', $row->id);
                    $deleteUrl = route('loan-products.destroy', $row->id);
    
                    $btn = '<a href="' . $editUrl . '" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <form action="' . $deleteUrl . '" method="POST" style="display:inline;">';
                    $btn .= '@csrf';
                    $btn .= '@method("DELETE")';
                    $btn .= '<button type="submit" class="btn btn-danger btn-sm">Delete</button>';
                    $btn .= '</form>';
    
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
        // Pass the variable to the view
        $loanProducts = LoanProduct::all();
        return view('loan-products.index', compact('loanProducts'));
    }

    // Show the form for creating a new loan product
    public function create()
    {
        return view('loan-products.create'); // Add a create view
    }

    // Store a newly created loan product in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:loan_products',
            'minimum_amount' => 'required|numeric|min:0',
            'maximum_amount' => 'required|numeric|min:0',
            'interest_rate' => 'required|numeric|min:0|max:100',
            'currency' => 'required|string|size:3',
        ]);

        LoanProduct::create($validated);
        return redirect()->route('loan-products.index')->with('success', 'Loan product created successfully.');
    }

    // Show the form for editing a loan product
    public function edit($id)
    {
        $loanProduct = LoanProduct::findOrFail($id);
        return view('loan-products.edit', compact('loanProduct')); // Add an edit view
    }

    // Update an existing loan product
    public function update(Request $request, $id)
    {
        $loanProduct = LoanProduct::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'code' => 'sometimes|required|string|max:20|unique:loan_products,code,' . $loanProduct->id,
            'minimum_amount' => 'sometimes|required|numeric|min:0',
            'maximum_amount' => 'sometimes|required|numeric|min:0',
            'interest_rate' => 'sometimes|required|numeric|min:0|max:100',
            'currency' => 'sometimes|required|string|size:3',
        ]);

        $loanProduct->update($validated);
        return redirect()->route('loan-products.index')->with('success', 'Loan product updated successfully.');
    }

    // Delete a loan product
    public function destroy($id)
    {
        $loanProduct = LoanProduct::findOrFail($id);
        $loanProduct->delete();
        return redirect()->route('loan-products.index')->with('success', 'Loan product deleted successfully.');
    }
}
