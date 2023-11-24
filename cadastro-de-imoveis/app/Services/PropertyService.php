<?php
namespace App\Services;

use App\Models\Property;

class PropertyService 
{
    public function dataProperty($data)  {
        $datas = [
                    'title' => $data['inputTitle'],
                    'code' => $data['inputCod'],
                    'number_of_rooms' => $data['inputNumberOfRooms'],
                    'value' => $data['inputvalue'],
                    'construction_date' => $data['inputConstructionDate'],
                    'others' => $data['inputOthers'],
                    'category_id' => $data['inputCategory']
                ];

        return $datas;
    }

    public function listProperty($data)  {
        $datas = $data['inputText'];

        $listProperty = Property::when($datas != null, function ($query) use ($datas) {
            return $query->where('title','like','%'.$datas.'%');
        })->get();

        return $listProperty;
    }
}
