<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_cats = Category::where('is_parent', 1)->orderBy('title', 'ASC')->get();
        return view('admin.category.create', compact('parent_cats'));
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
            'title' => 'string|required',
            'summary' => 'string|nullable',
            'is_parent' => 'sometimes|in:1',
            'parent_id' => 'nullable|exists:categories,id',
            'status' => 'nullable|in:active,inactive',
        ]);

        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Category::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = time() . '-' . $slug;
        }
        $data['slug'] = $slug;
        $data['is_parent'] = $request->input('is_parent', 0);
        $status = Category::create($data);
        if ($status) {
            return redirect()->route('category.index')->with('success', 'Successfully created category');
        } else {
            return back()->with('errors', 'Error creating category');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $parent_cats = Category::where('is_parent', 1)->orderBy('title', 'ASC')->get();
        if ($category) {
            return view('admin.category.edit', compact('category', 'parent_cats'));
        } else {
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
        $category = Category::where('slug', $slug)->firstOrFail();
        if ($category) {
            $this->validate($request, [
                'title' => 'string|required',
                'summary' => 'string|nullable',
                'is_parent' => 'sometimes|in:1',
                'parent_id' => 'nullable|exists:categories,id',
                'status' => 'required|in:active,inactive',
            ]);

            $data = $request->all();


            $slug = Str::slug($request->input('title'));
            $slug_count = Category::where('slug', $slug)->count();
            if ($slug_count > 0) {
                $slug = time() . '-' . $slug;
            }

            $data['slug'] = $slug;

            if ($request->is_parent == 1) {
                $data['parent_id'] = null;
            }

            $data['is_parent'] = $request->input('is_parent', 0);
            $status = $category->fill($data)->save();

            if ($status) {
                return redirect()->route('category.index')->with('success', 'Successfully updated category');
            } else {
                return back()->with('errors', 'Error updating category');
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
        $category = Category::where('slug', $slug)->firstOrFail();
        $child_cat_id = Category::where('parent_id', $slug)->pluck('id');
        if ($category) {
            $status = $category->delete();
            if ($status) {
                if (count($child_cat_id)) {
                    Category::shiftChild($child_cat_id);
                }
                return redirect()->route('category.index')->with('success', 'Category deleted successfully');
            } else {
                return back()->with('error', 'Something went wrong');
            }
        } else {
            return back()->with('error', 'Date not found');
        }
    }

    public function getChildByParentID(Request $request, $id)
    {
        $category = Category::find($request->id);
        if ($category) {
            $child_id = Category::getChildByParentID($request->id);
            if (count($child_id) <= 0) {
                return response()->json(['status' => false, 'data' => null, 'msg' => '']);
            }
            return response()->json(['status' => true, 'data' => $child_id, 'msg' => '']);
        } else {
            return response()->json(['status' => false, 'data' => null, 'msg' => 'Category not found']);
        }
    }
}
