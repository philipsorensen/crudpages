<form action="@if (isset($page)) {{ route('admin.crudpages.edit', ['id' => $page->id]) }} @else {{ route('admin.crudpages.create') }} @endif" method="post">
	@csrf

	<div class="row">
		<x-formcomponents::input col="col-sm-6" id="slug" inputmode="url" name="Slug" :value="old('slug', isset($page) ? $page->slug : '')" />
		<x-formcomponents::input col="col-sm-6" id="title" name="Title" :value="old('title', isset($page) ? $page->title : '')" />
		<x-formcomponents::input id="description" name="Description" :value="old('description', isset($page) ? $page->description : '')" />
		
		<x-formcomponents::text id="text" name="Text" rows="12" :value="old('text', isset($page) ? $page->text : '')" />

		<x-formcomponents::button>
			@if (isset($page))
				Update page
			@else
				Create page
			@endif
		</x-formcomponents::button>
	</div>
</form>