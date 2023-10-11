@extends('layout.app')
@if ($page->title !== '')
	@section('meta_title', $page->title)
@endif
@if ($page->ogimage !== '')
	@section('og_image', asset($page->ogimage))
@endif
@section('meta_description', $page->description)

@section('content')
{!! $page->getText() !!}
@endsection