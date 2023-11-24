<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Models\Category;
use App\Models\Property;
use App\Services\PropertyService;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function __construct(
        private PropertyService $propertyService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $listProperty = $this->propertyService->listProperty($request);

        if ($request->ajax()) {
            return view('property.lista')->with('listProperty',$listProperty);
        }

        return view('property.Propertylist');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lisCategory = Category::get();

        return view('property.propertyadd')->with('lisCategory',$lisCategory);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $storePropertyRequest)
    {
        Property::create($this->propertyService->dataProperty($storePropertyRequest->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $editProperty = Property::find($id);
        $listCategory = Category::get();

        return response()->json(['property'=>$editProperty,'category'=>$listCategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $updatePropertyRequest, $id)
    {
        Property::find($id)->update($this->propertyService->dataProperty($updatePropertyRequest->validated()));

        return response()->json('Atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Property::find($id)->delete();

        return response ()-> json ([ 'success' => 'Imovél deletado com sucesso.' ]);
    }
}
