@extends('layout.app')
@section('meta_title', trans('crudpages::page.pages'))

@section('content')
<h1>{{ trans('crudpages::page.pages') }}</h1>
<x-crudpages::status />

<a class="btn btn-light mb-3" href="{{ route($baseroute . 'create') }}">
	<x-bootstrapicons::plus-circle color="green" size="20" />
	{{ trans('crudpages::page.createanewpage') }}
</a>

<table class="table table-hover table-list">
	<thead>
		<td>{{ trans('crudpages::page.slug') }}</td>
		<td>{{ trans('crudpages::page.title') }}</td>
		<td>{{ trans('crudpages::page.image') }}</td>
		<td>{{ trans('crudpages::page.description') }}</td>
		<td class="text-center">{{ trans('crudpages::page.active') }}</td>
		<td class="text-center" colspan="2">{{ trans('crudpages::page.actions') }}</td>
	</thead>
	@forelse ($pages as $page)
		<tr>
			<td>
				<a href="{{ route('page.show', ['slug' => $page->slug]) }}" target="_blank">{{ $page->slug }}</a>
			</td>
			<td>{{ $page->title }}</td>
			<td>
				@if ($page->ogimage)
					<a href="{{ $page->getOGImage() }}" target="_blank">
						<img class="img-fluid rounded-4" src="{{ $page->getOGImage() }}">
					</a>
				@endif
			</td>
			<td>{{ $page->description }}</td>
			<td class="text-center">
				<a href="{{ route($baseroute . 'toggle', ['id' => $page->id]) }}">
					@if ($page->active)
						<x-bootstrapicons::check-circle color="green" />
					@else
						<x-iconcbootstrapiconsomponents::x-circle color="red" />
					@endif 
				</a>
			</td>
			<td class="text-center">
				<a class="me-4" href="{{ route($baseroute . 'edit', ['id' => $page->id]) }}" title="{{ trans('admin.crudpages::page.edit') }}">
					<x-bootstrapicons::pencil-square />
				</a>
			</td>
			<td class="text-center">
				<a class="text-danger" href="{{ route($baseroute . 'delete', ['id' => $page->id]) }}" onclick="return confirm('{{ trans('crudpages::page.deleteaffirmation', ['name' => $page->title]) }}')"  title="{{ trans('crudpages::page.delete') }}">
					<x-bootstrapicons::trash color="red" />
				</a>
			</td>
		</tr>
	@empty
		<tr>
			<td class="text-center" colspan="6">{{ trans('crudpages::page.nopagesyet') }}.</td>
		</tr>
	@endforelse
</table>
@endsection