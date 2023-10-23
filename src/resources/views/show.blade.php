@extends('layout.app')
@if ($page->title !== '')
	@section('meta_title', $page->title)
@endif
@if ($page->ogimage !== null)
	@section('og_image', $page->getOGImage())
@endif
@section('meta_description', $page->description)

@section('content')
{!! $page->getText() !!}
@endsection