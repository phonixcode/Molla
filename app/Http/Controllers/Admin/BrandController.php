<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderBy('id', 'DESC')->get();
        return view('admin.brand.index', compact('brands'));
    }

    public function brandStatus(Request $request, Brand $brand)
    {
        Helper::toggleStatus($request, $brand);
        return response()->json(['msg' => 'Status updated successfully.', 'status' => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'  => 'string|required',
            'photo' => 'required',
            'status' => 'nullable|in:active,inactive',
        ]);

        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Brand::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = time() . '-' . $slug;
        }

        $data['slug'] = $slug;
        $status = Brand::create($data);

        if ($status) {
            return redirect()->route('brand.index')->with('success', 'Successfully created brand');
        } else {
            return back()->with('errors', 'Error creating brand');
        }
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
    public function edit($slug)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();
        if($brand){
            return view('admin.brand.edit', compact('brand'));
        }else{
            return back()->with('error', 'Date not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();
        if ($brand) {
            $this->validate($request, [
                'title'  => 'string|required',
                'photo' => 'required',
                'status' => 'nullable|in:active,inactive',
            ]);

            $data = $request->all();

            $slug = Str::slug($request->input('title'));
            $slug_count = Brand::where('slug', $slug)->count();
            if ($slug_count > 0) {
                $slug = time() . '-' . $slug;
            }
            $data['slug'] = $slug;

            $status = $brand->fill($data)->save();
            if ($status) {
                return redirect()->route('brand.index')->with('success', 'Successfully updated brand');
            } else {
                return back()->with('errors', 'Error creating brand');
            }
        } else {
            return back()->with('error', 'Date not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();

        if ($brand) {
            $status = $brand->delete();
            if($status){
                return redirect()->route('brand.index')->with('success', 'Brand deleted successfully');
            }else{
                return back()->with('error', 'Something went wrong');
            }
        } else {
            return back()->with('error', 'Date not found');
        }
    }
}
