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

}
