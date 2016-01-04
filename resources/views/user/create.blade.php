@extends('admin')

@section('content')
    @include('helpers.create_body', ['type' => 'user', 'prefix' => 'admin'])
@stop