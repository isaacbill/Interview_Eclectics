@extends('adminlte::page')

@section('title', 'Customers')
@section('css')
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
@stop

@section('content')
    <h2>Customers</h2>
    <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">Create New Customer</a>

    @if($customers->isEmpty())
        <p>No customers available.</p>
    @else
        <table class="table" id="customersTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>DOB</th>
                    <th>Phone Number</th>
                    <th>ID Number</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ \Carbon\Carbon::parse($customer->dob)->format('d/m/Y') }}</td>
                        <td>{{ $customer->phone_number }}</td>
                        <td>{{ $customer->id_number }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>
                            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-sm btn-info">Edit</a>
                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline;">
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
        $('#customersTable').DataTable({
            "ordering": true,
            "searching": true,
            "paging": true,
            "lengthChange": true,
            "pageLength": 10,
        });
    });
</script>
@endsection
