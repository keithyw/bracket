@extends('admin')
@section('content')
    @include('helpers.show_body', ['type' => 'users', 'model' => $model, 'details' => 'user.details', 'prefix' => 'admin'])
@stop