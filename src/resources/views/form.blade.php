<form action="@if (isset($page)) {{ route('admin.crudpages.edit', ['id' => $page->id]) }} @else {{ route('admin.crudpages.create') }} @endif" method="post">
	@csrf

	<div class="row">
		<x-formcomponents::input col="col-sm-6" id="slug" inputmode="url" :name="trans('crudpages::page.slug')" :value="old('slug', isset($page) ? $page->slug : '')" />
		<x-formcomponents::input col="col-sm-6" id="title" :name="trans('crudpages::page.title')" :value="old('title', isset($page) ? $page->title : '')" />
		<x-formcomponents::input id="description" :name="trans('crudpages::page.description')" :value="old('description', isset($page) ? $page->description : '')" />
		
		<x-formcomponents::text id="text" :name="trans('crudpages::page.text')" rows="12" :value="old('text', isset($page) ? $page->text : '')" />

		<x-formcomponents::button>
			@if (isset($page))
				{{ $trans('crudpages::page.update') }}
			@else
				{{ trans('crudpages::page.create') }}
			@endif
		</x-formcomponents::button>
	</div>
</form>