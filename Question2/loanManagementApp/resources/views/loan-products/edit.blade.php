@extends('layouts.app')

@section('title', 'Edit Loan Product')

@section('content')
    <h2>Edit Loan Product</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('loan-products.update', $loanProduct->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $loanProduct->name) }}" required>
        </div>

        <div class="form-group">
            <label for="code">Product Code</label>
            <input type="text" name="code" id="code" class="form-control" value="{{ old('code', $loanProduct->code) }}" required>
        </div>

        <div class="form-group">
            <label for="minimum_amount">Minimum Amount</label>
            <input type="number" name="minimum_amount" id="minimum_amount" class="form-control" value="{{ old('minimum_amount', $loanProduct->minimum_amount) }}" required>
        </div>

        <div class="form-group">
            <label for="maximum_amount">Maximum Amount</label>
            <input type="number" name="maximum_amount" id="maximum_amount" class="form-control" value="{{ old('maximum_amount', $loanProduct->maximum_amount) }}" required>
        </div>

        <div class="form-group">
            <label for="interest_rate">Interest Rate (%)</label>
            <input type="number" step="0.01" name="interest_rate" id="interest_rate" class="form-control" value="{{ old('interest_rate', $loanProduct->interest_rate) }}" required>
        </div>

        <div class="form-group">
            <label for="currency">Currency</label>
            <input type="text" name="currency" id="currency" class="form-control" value="{{ old('currency', $loanProduct->currency) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
@endsection
