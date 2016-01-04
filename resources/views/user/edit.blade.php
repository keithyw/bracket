@extends('admin')

@section('content')
    @include('helpers.edit_body', ['type' => 'user', 'model' => $model, 'prefix' => 'admin'])
@stop