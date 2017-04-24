<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Models\Category;
use App\Models\Seo;

class CategoryController extends Controller
{
    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->setPageInfo(trans('labels.category.manage'), trans('labels.category.sub_manage'));
        $categories = Category::paginate(20);
        $categories = $categories->load('parent')->putInPaginator($categories);

        return view('admin.category.index', compact('categories'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();
        $this->setPageInfo(trans('labels.category.create'), trans('labels.category.sub_create'));

        return view('admin.category.create', compact('categories'));
    }

    /**
     * Show edit form
     *
     * @param Category $category
     * @return $this
     */
    function edit(Category $category)
    {
        $this->setPageInfo(trans('labels.category.edit'), trans('labels.category.sub_edit'));

        $category->load('seo');
        $categories = Category::where($category->getKeyName(), '<>', $category->getKey())->get();

        return view('admin.category.edit', compact('category', 'categories'));
    }

    /**
     * Create new category
     *
     * @param StoreCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function store(StoreCategoryRequest $request)
    {
        ($category = Category::makeFromRequest($request))->save();

        $category->seo()->save(Seo::makeFromRequest($request));

        return redirect()->route('admin.category.index')->with(success(trans('alert.success')));
    }

    /**
     * Update category
     *
     * @param StoreCategoryRequest $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    function update(StoreCategoryRequest $request, Category $category)
    {
        ($category = Category::makeFromRequest($request, $category))->save();

        $category->seo()->update(Seo::makeFromRequest($request)->toArray());

        return redirect()->route('admin.category.index')->with(success(trans('alert.success')));
    }

    /**
     * Delete
     *
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.category.index')->with(success(trans('alert.success')));
    }
}
