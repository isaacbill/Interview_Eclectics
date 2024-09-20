@extends('layouts.app')

@section('title', 'Loan Application Details')

@section('content')
<div class="container">
    <h2>Loan Application Details</h2>
    
    <div class="card">
        <div class="card-body">
            <h5>Customer: {{ $loanApplication->customer->name }}</h5>
            <p><strong>Loan Product:</strong> {{ $loanApplication->loanProduct->name }}</p>
            <p><strong>Amount Requested:</strong> {{ $loanApplication->requested_amount }}</p>
            <p><strong>Status:</strong> {{ ucfirst($loanApplication->status) }}</p>
            <p><strong>Amount Disbursed:</strong> {{ $loanApplication->disbursed_at ? $loanApplication->requested_amount : 0 }}</p>
            <p><strong>Amount Repaid:</strong> {{ $loanApplication->repaid_at ? $loanApplication->requested_amount : 0 }}</p>
            <p><strong>Balance:</strong> {{ $loanApplication->repaid_at ? 0 : $loanApplication->requested_amount }}</p>
        </div>
    </div>
    
    <a href="{{ route('loan_applications.index') }}" class="btn btn-primary mt-3">Back to List</a>
</div>
@endsection
