@extends('admin')
@section('content')
    @include('helpers.list_body', ['type' => 'users', 'list' => $items, 'linkTextField' => 'email', 'prefix' => 'admin'])
@stop