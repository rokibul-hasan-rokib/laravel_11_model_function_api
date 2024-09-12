<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'status',
    ];

    final public function prepare_data(Request $request){
        return [
             "name" => $request->input('name'),
             "description" => $request->input('description'),
             "price" => $request->input('price'),
             "quantity" => $request->input("quantity"),
             "status" => $request->input('status'),
        ];
    }

    final public function storeProduct(Request $request): Builder|Model
    {
          return self::query()->create($this->prepare_data($request));
    }

    final public function updateProduct(Request $request, Builder|Model $product)
    {
        return $product->update($this->prepare_data($request));
    }

    final public function deleteProduct(Product $product){
        return $product->forceDelete();
    }

    final public function totalQuantitySum(){
        return $this->where('status',1)->sum('quantity');
    }

    final public function totalPriceSum(){
        return $this->where('status',1)->sum('price');
    }

}
