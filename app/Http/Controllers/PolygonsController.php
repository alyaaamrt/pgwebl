<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PolygonsModel;

class PolygonsController extends Controller
{
    public function __construct()
    {
        $this->polygon = new PolygonsModel();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate request
    $request->validate(
        [
            'name'=> 'required|unique:polygons,name',
            'description'=> 'required',
            'geom_polygon'=> 'required',
            'image'=> 'nullable|mimes:jpeg,png,jpg,gif,svg|max:1024'
        ],
        [
            'name.required'=> 'Name is required',
            'name.unique' => 'Name already exits',
            'description.required' => 'Description is required',
            'geom_polygon.required' => 'Geometry polygon is required',
        ]
    );

    //create image directory if not exists
    if (!is_dir('storage/images')) {
        mkdir('./storage/images', 0777);
     }

    //get image file
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $name_image = time() . "_polygon." . strtolower($image->getClientOriginalExtension());
        $image->move('storage/images', $name_image);
      } else {
        $name_image = null;
      }


    $data = [
        'geom' => $request->geom_polygon,
        'name' => $request->name,
        'description' => $request->description,
        'image' => $name_image,
    ];


    //Create data
    if (!PolygonsModel::create($data)){
        return redirect()->route('map')->with('error', 'Polygon failed to add');
    }

    return redirect()->route('map')->with('success', 'Polygon has been added');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imagefile = $this->polygon->find($id)->image;

        if(!$this->polygon->destroy($id)){
            return redirect()->route('map')->with('error', 'Polygon failed to delete');
        }

        if($imagefile !=null) {
            if (file_exists('./storage/images/' . $imagefile)) {
                unlink('./storage/images/' . $imagefile);
            }
        }

        return redirect()->route('map')->with('success', 'Polygon has been deleted');

    }
}

