@extends('layout.app')
@section('meta_title', 'Pages')

@section('content')
<h1>Pages</h1>
<x-crudpages::status />

<table class="table table-hover table-list">
	<thead>
		<td>URL</td>
		<td>Title</td>
		<td>Description</td>
		<td>Active</td>
		<td class="text-center" colspan="2">Actions</td>
	</thead>
	@if ($pages->isNotEmpty())
		@foreach ($pages as $page)
			<tr>
				<td>{{ $page->slug }}</td>
				<td>{{ $page->title }}</td>
				<td>{{ $page->description }}</td>
				<td>
					<a href="{{ route('crudpages.toggle', ['id' => $page->id]) }}">
						@if ($page->active)
							<x-iconcomponents::check-circle color="green" />
						@else
							<x-iconcomponents::x-circle color="red" />
						@endif 
					</a>
				</td>
				<td class="text-center">
					<a class="me-4" href="{{ route('crudpages.edit', ['id' => $page->id]) }}" title="Edit page">
						<x-iconcomponents::pencil-square />
					</a>
				</td>
				<td class="text-center">
					<a class="text-danger" href="{{ route('crudpages.delete', ['id' => $page->id]) }}" onclick="return confirm('Are you sure you want to delete the page titled &ldquo;{{ $page->title }}&rdquo;?')"  title="Delete page">
						<x-iconcomponents::trash color="red" />
					</a>
				</td>
			</tr>
		@endforeach
	@else
		<tr>
			<td class="text-center" colspan="6">No pages yet.</td>
		</tr>
	@endif
</table>

<a href="{{ route('crudpages.create') }}"><button class="btn btn-success mt-4">Create a new page</button></a>
@endsection