<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryContorller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategory = SubCategory::all();
        return response($subcategory, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $subcategory = (new SubCategory())->createSubCategory($request);
            DB::commit();
            return response()->json($subcategory, status: 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subcategroy)
    {
        return response()->json($subcategroy, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subcategory)
    {
        try {
            DB::beginTransaction();
            (new SubCategory())->updateSubCategory($request, $subcategory);
            DB::commit();
            return response()->json(["message" => "SubCategory updated Successfully"]);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subcategory)
    {
        try {
            DB::beginTransaction();
            (new SubCategory())->deleteSubCategory($subcategory);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
