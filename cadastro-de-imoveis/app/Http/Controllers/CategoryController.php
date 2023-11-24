<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryService $categoryService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $listCategory = $this->categoryService->listCategory($request);

        if ($request->ajax()) {
            return view('category.list')->with('listCategory',$listCategory);
        }

        return view('category.categorylist');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.categoryadd');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $storeCategoryRequest)
    {//dd($storeCategoryRequest->validated());
        $title = $storeCategoryRequest->validated();
        Category::create([ 'title' => $title['inputTitle'] ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $editCategory = Category::find($id);

        return response()->json(['category'=>$editCategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $updateCategoryRequest, $id)
    {
        $title = $updateCategoryRequest->validated();

        Category::find($id)->update(['title' =>$title['inputTitle']]);

        return response()->json(['success' => 'Categoria atualizado com sucesso.']);        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Category::find($id)->delete();

        return response()->json(['success' => 'Categoria deletado com sucesso.']);
    }
}
