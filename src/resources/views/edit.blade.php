@extends('layout.app')
@section('meta_title', trans('crudpages::page.edit'))

@section('content')
<h1>{{ trans('crudpages::page.edit') }}</h1>
@include('crudpages::form')

@include('crudpages::components.summernote')
@endsection