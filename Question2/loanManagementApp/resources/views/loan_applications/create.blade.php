@extends('adminlte::page')

@section('title', 'Create Loan Application')

@section('content')
    <h2>Create Loan Application</h2>
    <form action="{{ route('loan_applications.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="customer_id">Customer</label>
            <select name="customer_id" id="customer_id" class="form-control" required>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="loan_product_id">Loan Product</label>
            <select name="loan_product_id" id="loan_product_id" class="form-control" required>
                @foreach($loanProducts as $product)
                    <option value="{{ $product->id }}" data-min="{{ $product->minimum_amount }}" data-max="{{ $product->maximum_amount }}">
                        {{ $product->name }} ({{ number_format($product->minimum_amount, 2) }} - {{ number_format($product->maximum_amount, 2) }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="requested_amount">Amount</label>
            <input type="number" name="requested_amount" id="requested_amount" class="form-control" required>
            <small class="form-text text-muted" id="amountHelp"></small>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#loan_product_id').change(function() {
            var selectedProduct = $(this).find(':selected');
            var minAmount = selectedProduct.data('min');
            var maxAmount = selectedProduct.data('max');

            $('#amountHelp').text('Amount must be between ' + minAmount + ' and ' + maxAmount + '.');

            // Update the input attributes for min and max
            $('#requested_amount').attr('min', minAmount);
            $('#requested_amount').attr('max', maxAmount);
        }).trigger('change'); // Trigger change to set initial limits
    });
</script>
@endsection
