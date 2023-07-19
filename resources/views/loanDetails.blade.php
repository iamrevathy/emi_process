


<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    
</head>
@extends('layouts.app')

@section('content')
<body>
    <div class="container">
    <h1>Loan Details</h1>
        <table class="table table-custom">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>num_of_payment </th>
                    <th>first_payment_date</th>
                    <th>last_payment_date</th>
                    <th>loan_amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loanDetails as $loanDetail)
                <tr>
                    <td>{{ $loanDetail->clientid }}</td>
                    <td>{{ $loanDetail->num_of_payment }}</td>
                    <td>{{ $loanDetail->first_payment_date }}</td>
                    <td>{{ $loanDetail->last_payment_date }}</td>
                    <td>{{ $loanDetail->loan_amount }}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</body>

</html>
@endsection
