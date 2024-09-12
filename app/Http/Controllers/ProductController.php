<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

      $products = Product::where('status', 1)->get();

      $totalQuantity = (new Product())->totalQuantitySum();
      $totalPrice  =  (new Product())->totalPriceSum();

      return response()->json([
          'products' => $products,
          'total_quantity' => $totalQuantity,
          'total_price' => $totalPrice
      ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
             try {
                DB::beginTransaction();
                $product = (new Product())->storeProduct($request);
                DB::commit();
                return response()->json($product, status: 201);
            } catch (\Throwable $e) {
                return redirect()->json(["message"=> "error"]);

             }
    }

//     public function store(Request $request)
// {
//     $validated = $request->validate([
//         'name' => 'required|string|max:255',
//         'price' => 'required|numeric',
//         'description' => 'nullable|string',
//         'quantity' => 'required|integer',
//         'status' => 'required|boolean',
//     ]);

//     $product = Product::create($validated);

//     return response()->json($product, 201);
// }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        try {
            DB::beginTransaction();
            $product = (new Product())->updateProduct($request,$product);
            DB::commit();
            return response()->json($product, 201);
        } catch (\Throwable $th) {
            return redirect()->json(["message"=> "error"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();
            $product = (new Product())->deleteProduct($product);
            DB::commit();
            return response()->json(["message" => "Product Deleted Successfully"]);
        } catch (\Throwable $th) {
            return redirect()->json(["message"=> "error"]);
        }
    }
}
