<h1>Sider</h1>
<x-crudpages::status />

<table class="table table-hover table-list">
	<thead>
		<td>URL</td>
		<td>Titel</td>
		<td>Beskrivelse</td>
		<td>Aktiv</td>
		<td class="text-center" colspan="2">Handlinger</td>
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
							<x-crudpages::icon.check-circle color="green" />
						@else
							<x-crudpages::icon.x-circle color="red" />
						@endif 
					</a>
				</td>
				<td class="text-center">
					<a class="me-4" href="{{ route('crudpages.edit', ['id' => $page->id]) }}" title="Edit page">
						<x-crudpages::icon.pencil-square />
					</a>
				</td>
				<td class="text-center">
					<a class="text-danger" href="{{ route('crudpages.delete', ['id' => $page->id]) }}" onclick="return confirm('Are you sure you want to delete the page titled &ldquo;{{ $page->title }}&rdquo;?')"  title="Delete page">
						<x-crudpages::icon.trash color="red" />
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

<a href="{{ route('crudpages.create') }}"><button class="btn btn-success mt-4">Opret en ny side</button></a>