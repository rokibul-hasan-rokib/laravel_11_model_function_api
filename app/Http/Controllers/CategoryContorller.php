<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryContorller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response($categories, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $category = (new Category())->storeCategory($request);
            DB::commit();
            return response()->json($category, status: 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(["message" => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $categroy)
    {
        return redirect($categroy,201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        try{
          DB::beginTransaction();
          $category = (new Category())->updateCategory($request, $category);
          DB::commit();
          return response()->json(["message" => "Category updated Successfully"]);
        }catch(\Throwable $th){
            DB::rollBack();
            return response()->json(["message"=> $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            DB::beginTransaction();
            $category = (new Category())->deleteCategory($category);
            DB::commit();
            return response()->json(["message" => "Category Deleted Successfully"]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(["message"=>$th->getMessage()]);
        }
    }
}
