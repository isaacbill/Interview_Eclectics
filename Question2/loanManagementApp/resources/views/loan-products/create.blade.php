@extends('layouts.app')

@section('title', 'Create Loan Product')

@section('content')
    <h2>Create Loan Product</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('loan-products.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="code">Product Code</label>
            <input type="text" name="code" id="code" class="form-control" value="{{ old('code') }}" required>
        </div>

        <div class="form-group">
            <label for="minimum_amount">Minimum Amount</label>
            <input type="number" name="minimum_amount" id="minimum_amount" class="form-control" value="{{ old('minimum_amount') }}" required>
        </div>

        <div class="form-group">
            <label for="maximum_amount">Maximum Amount</label>
            <input type="number" name="maximum_amount" id="maximum_amount" class="form-control" value="{{ old('maximum_amount') }}" required>
        </div>

        <div class="form-group">
            <label for="interest_rate">Interest Rate (%)</label>
            <input type="number" step="0.01" name="interest_rate" id="interest_rate" class="form-control" value="{{ old('interest_rate') }}" required>
        </div>

        <div class="form-group">
            <label for="currency">Currency</label>
            <input type="text" name="currency" id="currency" class="form-control" value="{{ old('currency') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Product</button>
    </form>
@endsection
