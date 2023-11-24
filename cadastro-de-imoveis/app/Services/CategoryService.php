<?php
namespace App\Services;

use App\Models\Category;

class CategoryService 
{
    public function listCategory($data)  {
        $datas = $data['inputText'];

        $listCategory = Category::when($datas != null, function ($query) use ($datas) {
            return $query->where('title','like','%'.$datas.'%');
        })->get();

        return $listCategory;
    }
}