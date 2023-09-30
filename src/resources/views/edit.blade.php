@extends('layout.app')
@section('meta_title', trans('crudpagess::page.edit'))

@section('content')
<h1>trans('crudpagess::page.edit')</h1>
@include('crudpages::form')

@include('crudpages::components.summernote')
@endsection