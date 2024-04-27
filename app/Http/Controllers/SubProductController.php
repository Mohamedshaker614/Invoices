<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\SubProduct;
use Illuminate\Http\Request;

class SubProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
        $subproducts = SubProduct::paginate();
        return view('InvoiceList.subproduct.index', compact('subproducts', 'sections'));
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
        $validated = $request->validate([
            'Product_name' => 'required|string|max:255|nullable',
            'description' => 'string',

        ]);

        SubProduct::create([
            'Product_name' => $validated['Product_name'],
            'description' => $validated['description'],
            'section_id' => $request->section_id
        ]);
        session()->flash('Add', 'تم اضافة المنتج بنجاح ');
        return redirect()->route('subproducts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubProduct $subProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $subproduct = SubProduct::findOrFail($id);
        $sections = Section::all();
        return view('InvoiceList.subproduct.edit', compact('subproduct', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'Product_name' => 'required|string|max:255|nullable',
            'description' => 'string',
            'section_id' => 'sometimes|nullable'
        ]);

        $product = SubProduct::findOrFail($id);
        $product->update($validated);
        session()->flash('edit', 'تم تعديل المنتج بنجاح ');
        return redirect()->route('subproducts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        SubProduct::findOrFail($id)->where('id', $id)->delete();
        session()->flash('delete', 'تم حذف القسم بنجاح');
        return redirect()->back();
    }
}
