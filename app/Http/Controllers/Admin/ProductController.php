<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->get();
        return view('admin.product.index', compact('products'));
    }

    public function productStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('products')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('products')->where('id', $request->id)->update(['status' => 'inactive']);
        }

        return response()->json(['msg' => 'Status updated successfully.', 'status' => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();

        $slug = Str::slug($request->input('title'));
        $slug_count = Product::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = time() . '-' . $slug;
        }
        $data['slug'] = $slug;
        $data['offer_price'] = ($request->price - (($request->price * $request->discount) / 100));

        $status = Product::create($data);

        return $status
        ? redirect()->route('product.index')->with('success', 'Successfully created product')
        : back()->with('errors', 'Error creating product');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product
        ? view('admin.product.show', compact('product'))
        : back()->with('error', 'Product not found');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return $product
        ? view('admin.product.edit', compact('product'))
        : back()->with('error', 'Date not found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        if ($product) {
            $data = $request->all();

            $slug = Str::slug($request->input('title'));
            $slug_count = Product::where('slug', $slug)->count();
            if ($slug_count > 0) {
                $slug = time() . '-' . $slug;
            }
            $data['slug'] = $slug;

            $data['offer_price'] = ($request->price - (($request->price * $request->discount) / 100));

            $status = $product->fill($data)->save();

            if ($status) {
                return redirect()->route('product.index')->with('success', 'Product Successfully updated');
            } else {
                return back()->with('errors', 'Error updating product');
            }
        } else {
            return back()->with('error', 'Date not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product) {
            return ($product->delete())
            ? redirect()->route('product.index')->with('success', 'Product deleted successfully')
            : back()->with('error', 'Something went wrong');
        } else {
            return back()->with('error', 'Date not found');
        }
    }

    /**
     * Display the attributes of the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function attribute(Product $product)
    {
        $product_attributes = ProductAttribute::where('product_id', $product->id)->orderBy('id', 'DESC')->get();
        return $product
        ? view('admin.product.product-attribute', compact('product', 'product_attributes'))
        : back()->with('error', 'Product not found');
    }

     /**
     * Store a newly created attribute resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function storeProductAttribute(Request $request, Product $product)
    {
        // $this->validate($request,[
        //     'size'              => 'nullable|string',
        //     'original_price'    => 'nullable|numeric',
        //     'offer_price'       => 'nullable|numeric',
        //     'stock'             => 'nullable|numeric',
        // ]);

        $data = $request->all();

        foreach ($data['original_price'] as $key => $value) {
            if(!empty($value)){
                $attribute = new ProductAttribute;
                $attribute['original_price'] = $value;
                $attribute['offer_price'] = $data['offer_price'][$key];
                $attribute['stock'] = $data['stock'][$key];
                $attribute['product_id'] = $product->id;
                $attribute['size'] = $data['size'][$key];
                $attribute->save();

            }
        }

        return redirect()->route('product.attribute', $product->uuid)->with('success', 'Product attribute successfully added');
    }

    /**
     * Remove the specified attribute resource from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroyProductAttribute($uuid)
    {
        $productAttribute = ProductAttribute::where('uuid', $uuid)->firstOrFail();
        if ($productAttribute) {
            return ($productAttribute->delete())
            ? redirect()->back()->with('success', 'Product attribute successfully deleted successfully')
            : back()->with('error', 'Something went wrong');
        } else {
            return back()->with('error', 'Date not found');
        }
    }
}
