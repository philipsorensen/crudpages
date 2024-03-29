<form action="@if (isset($page)) {{ route('admin.crudpages.edit', ['id' => $page->id]) }} @else {{ route('admin.crudpages.create') }} @endif" enctype="multipart/form-data" method="post">
	@csrf

	<div class="row">
		<x-formcomponents::input col="col-sm-6 order-1" id="slug" inputmode="url" :name="trans('crudpages::page.slug')" :tooltip="config('crudpages.tooltips.slug')" :value="old('slug', isset($page) ? $page->slug : '')" />
		<x-formcomponents::input col="col-md-6 order-3 order-md-2" id="title" :name="trans('crudpages::page.title')" :tooltip="config('crudpages.tooltips.title')" :value="old('title', isset($page) ? $page->title : '')" />
		<x-formcomponents::image col="col-sm-6 order-2 order-md-3" :name="trans('crudpages::page.image.label')" :tooltip="config('crudpages.tooltips.image')" />
		<x-formcomponents::input col="col-12 order-4" id="description" :name="trans('crudpages::page.description')" :tooltip="config('crudpages.tooltips.description')" :value="old('description', isset($page) ? $page->description : '')" />
		
		<x-formcomponents::text col="col-12 order-5" id="text" :name="trans('crudpages::page.text')" rows="18" :tooltip="config('crudpages.tooltips.text')" :value="old('text', isset($page) ? $page->text : '')" />
	</div>
	<div class="row">
		<x-formcomponents::button onclick="summernoteSubmit();">
			@if (isset($page))
				{{ trans('crudpages::page.update') }}
			@else
				{{ trans('crudpages::page.create') }}
			@endif
		</x-formcomponents::button>
	</div>
</form>