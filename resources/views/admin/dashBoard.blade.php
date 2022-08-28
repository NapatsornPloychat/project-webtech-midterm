
@extends('layouts.main')
@section('content')
@include('layouts.chart')

<div>
    <input type="button" value="export to pdf" onclick="window.print()" />
</div>

@endsection
