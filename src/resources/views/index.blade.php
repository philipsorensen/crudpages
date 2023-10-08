@extends('layout.app')
@section('meta_title', trans('crudpages::page.pages'))

@section('content')
<h1>{{ trans('crudpages::page.pages') }}</h1>
<x-crudpages::status />

<table class="table table-hover table-list">
	<thead>
		<td>{{ trans('crudpages::page.slug') }}</td>
		<td>{{ trans('crudpages::page.title') }}</td>
		<td>{{ trans('crudpages::page.description') }}</td>
		<td class="text-center">{{ trans('crudpages::page.active') }}</td>
		<td class="text-center" colspan="2">{{ trans('crudpages::page.actions') }}</td>
	</thead>
	@if ($pages->isNotEmpty())
		@foreach ($pages as $page)
			<tr>
				<td>{{ $page->slug }}</td>
				<td>{{ $page->title }}</td>
				<td>{{ $page->description }}</td>
				<td class="text-center">
					<a href="{{ route('admin.crudpages.toggle', ['id' => $page->id]) }}">
						@if ($page->active)
							<x-iconcomponents::check-circle color="green" />
						@else
							<x-iconcomponents::x-circle color="red" />
						@endif 
					</a>
				</td>
				<td class="text-center">
					<a class="me-4" href="{{ route('admin.crudpages.edit', ['id' => $page->id]) }}" title="{{ trans('admin.crudpages::page.edit') }}">
						<x-iconcomponents::pencil-square />
					</a>
				</td>
				<td class="text-center">
					<a class="text-danger" href="{{ route('admin.crudpages.delete', ['id' => $page->id]) }}" onclick="return confirm('{{ trans('crudpages::page.deleteaffirmation', ['name' => $page->title]) }}')"  title="{{ trans('crudpages::page.delete') }}">
						<x-iconcomponents::trash color="red" />
					</a>
				</td>
			</tr>
		@endforeach
	@else
		<tr>
			<td class="text-center" colspan="6">{{ trans('crudpages::page.nopagesyet') }}.</td>
		</tr>
	@endif
</table>

<a href="{{ route('admin.crudpages.create') }}"><button class="btn btn-success mt-4">{{ trans('crudpages::page.createanewpage') }}</button></a>
@endsection