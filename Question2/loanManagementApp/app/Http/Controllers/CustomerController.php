<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $editUrl = route('customers.edit', $row->id);
                    $deleteUrl = route('customers.destroy', $row->id);
    
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
    
        // Fetch all customers for the initial page load
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }
    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:customers,email', // Ensure it's a valid email and unique
            'dob' => 'required|date|before:today', // Allow only past dates
            'phone_number' => 'required|numeric', // Ensure it’s numeric
            'id_number' => 'required|numeric', // Ensure it’s numeric
            'address' => 'required|string|max:500',
        ]);
    
        Customer::create($validated);
        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'dob' => 'required|date',
            'phone_number' => 'required|string|max:20',
            'id_number' => 'required|string|unique:customers,id_number,' . $customer->id,
            'address' => 'required|string',
        ]);

        $customer->update($validated);
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
