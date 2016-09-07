<?php

namespace App\Http\Controllers;

use App\uiElement;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\File;

class UIElementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $elements = uiElement::all();
        return view('ui-elements.index',compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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

    public function getElement(Request $request)
    {
        $uiElement = uiElement::find($request->id);
        $uiElement->code = view($uiElement->file_path)->render();
        return $uiElement;
    }

    public function getAllElements()
    {
        return uiElement::all();
    }

    public function saveElement(Request $request)
    {
        if($request->id)
        {
            $uiElement = uiElement::find($request->id);
        }else{
            $uiElement = new uiElement;
        }

        $uiElement->name = $request->name;
        $uiElement->file_path = $request->file_path;
        $uiElement->code = $request->code;
        $uiElement->updateViewFile($uiElement);
        unset($uiElement->code);
        $uiElement->save();
    }

    public function syncElements()
    {
        $Elements = uiElement::all();
        $element_names = array();
        foreach ($Elements as $element)
        {
            $element_names[] = $element->name;
        }
        $files = File::files(base_path('resources/views/ui-elements/elements'));
        foreach ($files as $file)
        {
            $file_name = str_replace('.blade.php','',basename($file));

            if(!in_array($file_name, $element_names))
            {
                $uiElement = new uiElement;
                $uiElement->name = $file_name;
                $file_path_with_ext = str_replace(base_path().'/resources/views/','',$file);
                $file_path_with_ext = str_replace(base_path().'\resources/views/','',$file_path_with_ext);
                $file_path = str_replace('.blade.php','',$file_path_with_ext);
                $uiElement->file_path = $file_path;
                $uiElement->save();
            }
        }
    }
}
