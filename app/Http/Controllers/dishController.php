<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\dishModel;

class dishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = dishModel::all();
        return view ('show_all_dishes')->with('dishes', $dishes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('add_new_dishes');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'dishName' => 'required',
            'dishPrice' => 'required',
            'dishDescription' => 'required',
        ]);

if ($request->dishImage)
{
    $validated = $request->validate([
        'dishImage' => 'nullable|file|image|mimes:jpeg,png,jpg|max:10000',
    ]);
    $imageName = date('mdYHis').uniqid().'.'.$request->dishImage->extension();
    $request->dishImage->move(public_path('uploaded_imgs'),$imageName);
}else{
    $imageName = 'no_image.png';
}

        $dishModel_obj = new dishModel;
        $dishModel_obj->dish_name = $request->dishName;
        $dishModel_obj->dish_price = $request->dishPrice;
        $dishModel_obj->dish_description = $request->dishDescription;
        $dishModel_obj->dish_image = $imageName;
        $dishModel_obj->save();
        $request->session()->flash('status','Dish inserted sucessfully');
        return redirect('dishes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dish = dishModel::find($id);
        return view ('edit_dish')->with('dish', $dish);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dishModel_obj = dishModel::find($id);
        $dishModel_obj->dish_name = $request->dishName;
        $dishModel_obj->dish_price = $request->dishPrice;
        $dishModel_obj->dish_description = $request->dishDescription;
        $dishModel_obj->save();
        $request->session()->flash('status','Dish updated sucessfully');
        return redirect('dishes');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
