<!-- resources/views/process-data.blade.php -->

@extends('layouts.app')


@section('content')
<div class="container">
    @if (Session::has('message'))
    <div class="col-md-6 alert alert-success">
        {{ Session::get('message') }}
    </div>
    @endif
    <h1>Process Data</h1>
    <a class="btn btn-primary" href="{{route('process.save')}}">Process Data</a>
</div>

@if(isset($data))
<div class="table-responsive">
    <table class="table table-custom">
        <thead>
            <tr>

                <th>Client ID</th>
                @foreach ($columns as $column)
               
                <th>{{$column}}</th>
                
                @endforeach
            </tr>
        </thead>
        <tbody>
          
        @foreach ($data as $items)
            <tr>
                <td>{{$items['client_id']}}</td>
                @foreach ($items['month_details'] as $key=>$item)
                <td>{{$item}}
                @endforeach
                </td>
                
             </tr>
              
                @endforeach
        </tbody>

    </table>
</div>

@endif

@endsection