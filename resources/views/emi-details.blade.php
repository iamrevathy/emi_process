<!-- resources/views/process-data.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Process Data</h1>
    <a class="btn btn-primary" href="{{route('process.save')}}">Process Data</a>
</div>


<div class="table-responsive">
    <table class="table table-custom">
        <thead>
            <tr>

                <th>Client ID</th>
                @foreach ($data as $items)
                @foreach ($items['month_details'] as $key=>$item)
                <th>{{$key}}</th>
                @endforeach
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


@endsection