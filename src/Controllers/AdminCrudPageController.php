<?php

namespace PhilipSorensen\CrudPages\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PhilipSorensen\CrudPages\Models\CrudPage;

class AdminCrudPageController extends Controller
{
    public function create()
    {
        return view('crudpages::create');
    }

    public function delete(int $id)
    {
        $page = CrudPage::findOrFail($id);
        $page->delete();

        session()->flash('success', 'Side slettet.');
        return redirect()->route('admin.crudpages.index');
    }

    public function edit(int $id)
    {
        $page = CrudPage::findOrFail($id);
        return view('crudpages::edit')
                ->with('page', $page);
    }

    public function index()
    {
        $pages = CrudPage::orderBy('slug')->get();
        return view('crudpages::index')
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

        session()->flash('success', 'Side oprettet.');
        return redirect()->route('admin.crudpages.index');
    }

    public function toggleActive(int $id)
    {
        $page = CrudPage::findOrFail($id);
        $page->active = !$page->active;
        $page->save();

        session()->flash('success', 'Side opdateret.');
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

        session()->flash('success', 'Side opdateret.');
        return redirect()->route('admin.crudpages.index');
    }
}