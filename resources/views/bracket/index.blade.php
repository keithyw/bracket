@extends('layout')
@section('title')
    [[Brackets]]
@stop
@section('content')
    {!! Form::open(['url' => '/brackets']) !!}
    <div>
    {!! Form::textarea('text', '', ['placeholder' => 'Enter your message here',  'required']) !!}
    </div>
    <div>
    {!! Form::submit('Save') !!}
    </div>
    {!! Form::close() !!}
@stop