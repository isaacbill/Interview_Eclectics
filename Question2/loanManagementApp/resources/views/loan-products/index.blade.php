@extends('adminlte::page')

@section('title', 'Loan Products')
@section('css')
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
@stop

@section('content')
    <h2>Loan Products</h2>
    <a href="{{ route('loan-products.create') }}" class="btn btn-primary mb-3">Create New Product</a>

    @if($loanProducts->isEmpty())
        <p>No loan products available.</p>
    @else
        <table class="table" id="loanProductsTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Min Amount</th>
                    <th>Max Amount</th>
                    <th>Interest Rate</th>
                    <th>Currency</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($loanProducts as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->code }}</td>
                        <td>{{ number_format($product->minimum_amount, 2) }}</td>
                        <td>{{ number_format($product->maximum_amount, 2) }}</td>
                        <td>{{ $product->interest_rate }}%</td>
                        <td>{{ strtoupper($product->currency) }}</td>
                        <td>
                            <a href="{{ route('loan-products.edit', $product->id) }}" class="btn btn-sm btn-info">Edit</a>
                            <form action="{{ route('loan-products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#loanProductsTable').DataTable({
            "ordering": true,
            "searching": true,
            "paging": true,
            "lengthChange": true,
            "pageLength": 10,
        });
    });
</script>
@endsection
