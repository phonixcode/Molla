<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use App\Services\Status;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use Helper;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::getBanners();
        return view('admin.banner.index', compact('banners'));
    }

    public function bannerStatus(Request $request, Banner $banner)
    {
        Helper::toggleStatus($request, $banner);
        return response()->json(['msg' => 'Status updated successfully.', 'status' => true]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request)
    {
        $data = $request->validated();

        $slug = Str::slug($request->input('title'));
        $data['slug'] = $slug;

        return Banner::create($data)
            ? redirect()->route('banner.index')->with('success', 'Successfully created banner')
            : back()->with('errors', 'Error creating banner');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return $banner
            ? view('admin.banner.edit', compact('banner'))
            : back()->with('error', 'Date not found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BannerRequest $request, Banner $banner)
    {
        if ($banner) {
            $data = $request->validated();

            $slug = Str::slug($request->input('title'));
            $data['slug'] = $slug;

            return $banner->fill($data)->save()
                ? redirect()->route('banner.index')->with('success', 'Successfully updated banner')
                : back()->with('errors', 'Error creating banner');
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
    public function destroy(Banner $banner)
    {
        if ($banner) {
            return $banner->delete()
                ? redirect()->route('banner.index')->with('success', 'Banner deleted successfully')
                : back()->with('error', 'Something went wrong');
        } else {
            return back()->with('error', 'Date not found');
        }
    }
}
