@extends('layout.app')
@section('meta_title', trans('crudpages::page.create'))

@section('content')
<h1>{{ trans('crudpages::page.create') }}</h1>
@include('crudpages::form')

@include('crudpages::components.summernote')
@endsection