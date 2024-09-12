<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
          "name",
    ];

    final public function data_prepare(Request $request){
        return[
            "name" => $request->input('name'),
        ];
    }
    final public function storeCategory(Request $request): Builder|Model
    {
        return self::query()->create($this->data_prepare($request));
    }
    
    final public function updateCategory(Request $request, Builder|Model $category){
        return $category->update($this->data_prepare($request));
    }

    public function deleteCategory(Category $category){
        return $category->forceDelete();
    }

}
