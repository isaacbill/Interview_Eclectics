@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Loan Management System</h1>
@stop

@section('content')
    <p>Welcome.</p>

    <div class="row">
        <div class="col-md-4">
            <div class="card bg-dark text-white h-100">
                <div class="card-header">
                    <h5>User Management</h5>
                </div>
                <div class="card-body">
                    <p>A simple user management module that allows user creation and login.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-dark text-white h-100">
                <div class="card-header">
                    <h5>Loan Products Management</h5>
                </div>
                <div class="card-body">
                    <p>Create and update loan products with parameters like Name, Code, Minimum Amount, Maximum Amount, Interest Rate, and Currency.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-dark text-white h-100">
                <div class="card-header">
                    <h5>Customer Management</h5>
                </div>
                <div class="card-body">
                    <p>Create and update customers with their details such as Name, Email, DOB, Phone Number, ID Number, and Address.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-3">
            <div class="card bg-dark text-white h-100">
                <div class="card-header">
                    <h5>Loan Management</h5>
                </div>
                <div class="card-body">
                    <p>Choose a product and apply for a loan, approve, disburse, and repay loans based on product limits.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-3">
            <div class="card bg-dark text-white h-100">
                <div class="card-header">
                    <h5>Report</h5>
                </div>
                <div class="card-body">
                    <p>Prepare a simple list of loan applications indicating the status, amount applied, amount disbursed, amount repaid, and balance.</p>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
