<?php

namespace PhilipSorensen\CrudPages\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PhilipSorensen\CrudPages\Models\CrudPage;

class AdminCrudPageController extends Controller
{
	protected array $breadcrumbs = [];

    public function create()
    {
		$this->breadcrumbs[] = [trans('crudpages::page.pages'), route('admin.crudpages.index')];
        return view('crudpages::create')
				->with('breadcrumbs', $this->breadcrumbs);
    }

    public function delete(int $id)
    {
        $page = CrudPage::findOrFail($id);
        $page->delete();

        session()->flash('success', trans('crudpages::page.deleted') .'.');
        return redirect()->route('admin.crudpages.index');
    }

    public function edit(int $id)
    {
        $this->breadcrumbs[] = [trans('crudpages::page.pages'), route('admin.crudpages.index')];
        $page = CrudPage::findOrFail($id);
        return view('crudpages::edit')
				->with('breadcrumbs', $this->breadcrumbs)
                ->with('page', $page);
    }

    public function index()
    {
        $pages = CrudPage::orderBy('slug')->get();
        return view('crudpages::index')
				->with('breadcrumbs', $this->breadcrumbs)
                ->with('pages', $pages);
    }

	public function store(Request $request)
    {
		$validated = $request->validate([
			'slug' => ['string', 'nullable', 'unique:crud_pages'],
            'title' => ['nullable', 'string'],
            'description' => ['string', 'nullable'],
            'text' => 'string',
		], []);

        CrudPage::create([
            'slug' => $validated['slug'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'text' => $validated['text'],
        ]);

        session()->flash('success', trans('crudpages::page.created') . '.');
        return redirect()->route('admin.crudpages.index');
    }

    public function toggleActive(int $id)
    {
        $page = CrudPage::findOrFail($id);
        $page->active = !$page->active;
        $page->save();

        session()->flash('success', trans('crudpages::page.updated') . '.');
        return redirect()->route('admin.crudpages.index');
    }

	public function update(int $id, Request $request)
    {
        $page = CrudPage::findOrFail($id);
        $validated = $request->validate([
            'slug' => [
                'string',
                'nullable',
                Rule::unique('crud_pages')->ignore($page->id)
            ],
            'title' => ['nullable', 'string'],
            'description' => 'string|nullable',
            'text' => 'string',
        ], [
            // Messages.
        ]);

        $page->slug = $validated['slug'];
        $page->title = $validated['title'];
        $page->description = $validated['description'];
        $page->text = $validated['text'];
        $page->save();

        session()->flash('success', trans('crudpages::page.updated') . '.');
        return redirect()->route('admin.crudpages.index');
    }
}