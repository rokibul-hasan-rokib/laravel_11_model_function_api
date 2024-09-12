<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name','category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    final public function prepare_data(Request $request){
        return [
              "name" => $request->input('name'),
              "category_id" => $request->input('category_id'),
        ];
    }
    // protected function prepare_data(Request $request): array
    // {
    //     return $request->only(['category_id', 'name']);
    // }
    public function createSubCategory(Request $request): Builder|Model
    {
        return self::query()->create($this->prepare_data(($request)));
    }

    final public function updateSubCategory(Request $request, Builder|Model $subcategory) 
    {
           return $subcategory->update($this->prepare_data($request));
    }

    final public function deleteSubCategory(SubCategory $subcategory){
        return $subcategory->delete();
    }

    
}
