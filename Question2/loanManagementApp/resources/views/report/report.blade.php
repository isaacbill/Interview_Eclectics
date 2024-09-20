@extends('adminlte::page')

@section('title', 'Loan Applications Report')

@section('content')
    <h2>Loan Applications Report</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Loan Product</th>
                <th>Amount Applied</th>
                <th>Amount Disbursed</th>
                <th>Amount Repaid</th>
                <th>Balance</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loanApplications as $loanApplication)
                <tr>
                    <td>{{ $loanApplication->customer->name }}</td>
                    <td>{{ $loanApplication->loanProduct->name }}</td>
                    <td>{{ number_format($loanApplication->requested_amount, 2) }}</td>
                    <td>{{ number_format($loanApplication->amount_disbursed ?? 0, 2) }}</td>
                    <td>{{ number_format($loanApplication->amount_repaid ?? 0, 2) }}</td>
                    <td>{{ number_format(($loanApplication->amount_disbursed ?? 0) - ($loanApplication->amount_repaid ?? 0), 2) }}</td>
                    <td>{{ ucfirst($loanApplication->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mb-3">
        <a href="{{ route('loan_applications.index') }}" class="btn btn-secondary">Back</a>
        <button onclick="printReport()" class="btn btn-primary ml-2">Print</button>
    </div>

    <script>
        function printReport() {
            window.print();
        }
    </script>

    <style>
        @media print {
            .btn {
                display: none; /* Hide buttons when printing */
            }
        }
    </style>
@endsection
