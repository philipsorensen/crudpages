@extends('layout.app')
@if ($page->title !== '')
	@section('meta_title', $page->title)
@endif
@section('meta_description', $page->description)

@section('content')
{!! $page->getText() !!}
@endsection