@extends('adminlte::page')

@section('title', 'Loan Applications')

@section('css')
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
@stop

@section('content')
    <h2>Loan Applications</h2>
    <a href="{{ route('loan_applications.create') }}" class="btn btn-primary mb-3">Create New Application</a>
    <a href="{{ route('loan_applications.report') }}" class="btn btn-info mb-3">View Loan Applications Report</a>

    <table class="table" id="loanApplicationsTable">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Loan Product</th>
                <th>Requested Amount</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- The table will be populated by DataTables via AJAX -->
        </tbody>
    </table>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(function() {
        $('#loanApplicationsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('loan_applications.index') }}',
            columns: [
                {data: 'customer.name', name: 'customer.name'},
                {data: 'loan_product.name', name: 'loan_product.name'},
                {data: 'requested_amount', name: 'requested_amount'},
                {data: 'status', name: 'status'},
                {
                    data: 'id',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, full, meta) {
                    return `
                        <a href="/dashboard/loan_applications/${data}" class="btn btn-info btn-sm">Show</a>
                        <a href="{{ route('loan_applications.approve', '') }}/${data}" class="btn btn-success btn-sm">Approve</a>
                        <a href="{{ route('loan_applications.repay', '') }}/${data}" class="btn btn-warning btn-sm">Repay</a>
                    `;
                }

                },
            ]
        });
    });
</script>
@endpush
