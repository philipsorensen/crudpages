<?php

namespace PhilipSorensen\CrudPages\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use PhilipSorensen\CrudPages\Models\CrudPage;

class AdminCrudPageController extends Controller
{
	protected string $baseroute = 'admin.crudpages.';
	protected array $breadcrumbs = [];

    public function create()
    {
		$this->breadcrumbs[] = [trans('crudpages::page.pages'), route($this->baseroute . 'index')];
        return view('crudpages::create')
				->with('baseroute', $this->baseroute)
				->with('breadcrumbs', $this->breadcrumbs);
    }

    public function delete(int $id)
    {
        $page = CrudPage::findOrFail($id);
		if ($page->ogimage !== null)
		{
			Storage::delete('ogimages/' . $page->ogimage);
		}
        $page->delete();

        session()->flash('success', trans('crudpages::page.deleted') .'.');
        return redirect()->route($this->baseroute . 'index');
    }

    public function edit(int $id)
    {
        $this->breadcrumbs[] = [trans('crudpages::page.pages'), route($this->baseroute . 'index')];
        $page = CrudPage::findOrFail($id);
        return view('crudpages::edit')
				->with('baseroute', $this->baseroute)
				->with('breadcrumbs', $this->breadcrumbs)
                ->with('page', $page);
    }

    public function index()
    {
        $pages = CrudPage::orderBy('slug')->get();
        return view('crudpages::index')
				->with('baseroute', $this->baseroute)
				->with('breadcrumbs', $this->breadcrumbs)
                ->with('pages', $pages);
    }

	public function store(Request $request)
    {
		$validated = $request->validate([
			'slug' => ['string', 'unique:crud_pages'],
            'title' => ['max:70', 'nullable', 'string'],
            'description' => ['max:160', 'nullable', 'string'],
            'text' => 'string',
		], []);

		DB::transaction(function () use ($validated, $request) {
			$page = CrudPage::create([
				'slug' => Str::slug($validated['slug']),
				'title' => $validated['title'],
				'description' => $validated['description'],
				'text' => $validated['text'],
			]);

			if ($request->image !== null)
			{
				$path = "ogimages";
				$filename = Str::uuid() . '.' . $request->image->getClientOriginalExtension();
				$request->image->storeAs($path, $filename);

				$page->ogimage = $filename;
				$page->save();
			}
		});

        session()->flash('success', trans('crudpages::page.created') . '.');
        return redirect()->route($this->baseroute . 'index');
    }

    public function toggleActive(int $id)
    {
        $page = CrudPage::findOrFail($id);
        $page->active = !$page->active;
        $page->save();

        session()->flash('success', trans('crudpages::page.updated') . '.');
        return redirect()->route($this->baseroute . 'index');
    }

	public function update(int $id, Request $request)
    {
        $page = CrudPage::findOrFail($id);
        $validated = $request->validate([
            'slug' => [
                'string',
                Rule::unique('crud_pages')->ignore($page->id)
            ],
            'title' => ['max:70', 'nullable', 'string'],
            'description' => ['max:170', 'nullable', 'string'],
            'text' => 'string',
        ], [
            // Messages.
        ]);

        $page->slug = $validated['slug'];
        $page->title = $validated['title'];
        $page->description = $validated['description'];
        $page->text = $validated['text'];
        $page->save();

		if ($request->image !== null)
		{
			if ($page->ogimage !== null)
			{
				Storage::delete('ogimages/' . $page->ogimage);
			}

			$path = "ogimages";
			$filename = Str::uuid() . '.' . $request->image->getClientOriginalExtension();
			$request->image->storeAs($path, $filename);

			$page->ogimage = $filename;
			$page->save();
		}

        session()->flash('success', trans('crudpages::page.updated') . '.');
        return redirect()->route($this->baseroute . 'edit', ['id' => $page->id]);
    }
}