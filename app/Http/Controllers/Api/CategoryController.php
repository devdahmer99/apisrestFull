<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategoryFormRequest;

class CategoryController extends Controller
{
    private $category;
    private $totalPage = 10;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index(Category $category, Request $request)
    {
        $categories = $category->getResults($request->name);

        return response()->json($categories, 200);
    }

    public function show($id)
    {
        if(!$category = $this->category->find($id)) {
            return response()->json(['error' => 'Not Found!'], 404);
        }
        return response()->json($category);
    }

    public function store(StoreUpdateCategoryFormRequest $request)
    {
        $category = $this->category->create($request->all());
        return response()->json($category, 201);
    }

    public function update(StoreUpdateCategoryFormRequest $request, $id)
    {
        if(!$category = $this->category->find($id)) {
            return response()->json(['error' => 'Not Found!'], 404);
        }

        $category->update($request->all());

        return response()->json($category);
    }

    public function destroy($id)
    {
        if(!$category = $this->category->find($id)) {
            return response()->json(['error' => 'Not Found!'], 404);
        }

        $category->delete();

        return response()->json(['message' => 'Registro deletado com sucesso']);
    }


    public function products($id)
    {
        if(!$category = $this->category->find($id)) {
            return response()->json(['error' => 'Not Found!'], 404);
        }

        $products = $category->products()->paginate($this->totalPage);

        return response()->json([
            'category' => $category,
            'products' => $products,
        ]);
    }
}
