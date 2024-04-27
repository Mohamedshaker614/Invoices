<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\SubProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::paginate();
        return view('InvoiceList.sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'section_name' => 'required|string|unique:sections|max:255',
            'description' => 'string|nullable',
        ]);
        Section::create([
            'section_name' => $validated['section_name'],
            'description' => $validated['description'],
            'Created_by' => (Auth::user()->name),

        ]);
        session()->flash('Add', 'تم اضافة القسم بنجاح ');
        return redirect()->route('sections.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $section = Section::findOrFail($id);
        return view('InvoiceList.sections.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'section_name' => 'required|string|unique:sections|max:255',
            'description' => 'string|nullable',
        ]);
        $usections = Section::findOrFail($id);
        $usections->update([
            'section_name' => $validated['section_name'],
            'description' => $validated['description'],
            'Created_by' => (Auth::user()->name),
        ]);
        session()->flash('edit', 'تم تعديل القسم بنجاج');
        return redirect()->route('sections.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Section::findOrFail($id)->where('id', $id)->delete();
        session()->flash('delete', 'تم حذف القسم بنجاح');
        return redirect()->back();
    }

    public function getSectionProducts($id)
    {
        // $products = SubProduct::where('section_id', $id)->get();
        // return response()->json($products);
        $products = DB::table("sub_products")->where("section_id", $id)->pluck("Product_name", "id");
        return json_encode($products);
    }
}
