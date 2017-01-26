@extends('layouts.master')

@section('title', 'Page Title')

@include('partials.header', ['some' => 'Hi everybody!!!', ])

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar</p>
@endsection

@section('content')
    <p>This is my body content.</p>
@endsection
