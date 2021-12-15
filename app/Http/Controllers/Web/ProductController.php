<?php

namespace App\Http\Controllers\Web;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function products()
    {
        //return Product::with('brands')->get();
        $products = $this->getProduct();

        $categories = Category::where(['status' => 'active', 'is_parent' => 1])->with('products')->orderBy('title', 'Asc')->get();
        $brands = Brand::where(['status' => 'active'])->with('products')->get();

        return view('frontend.pages.product.product-grid', compact('products', 'categories', 'brands'));
    }

    public function productLists()
    {
        $products = $this->getProduct();

        $categories = Category::where(['status' => 'active', 'is_parent' => 1])->with('products')->orderBy('title', 'Asc')->get();
        $brands = Brand::where(['status' => 'active'])->with('products')->get();

        return view('frontend.pages.product.product-list', compact('products', 'categories', 'brands'));
    }

    private function getProduct()
    {
        $products = Product::query();

        if (!empty($_GET['category'])) {
            $slugs = explode(',', $_GET['category']);
            $cat_ids = Category::select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();
            $products = $products->whereIn('cat_id', $cat_ids);
        }

        if (!empty($_GET['brand'])) {
            $slugs = explode(',', $_GET['brand']);
            $brand_ids = Brand::select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();
            $products = $products->whereIn('brand_id', $brand_ids);
        }

        if(!empty($_GET['size'])){
            $products = $products->where('size', $_GET['size']);
        }

        if (!empty($_GET['sortBy'])) {
            if ($_GET['sortBy'] == 'priceAsc') {
                $products = $products->where(['status' => 'active'])->orderBy('offer_price', 'ASC');
            }
            if ($_GET['sortBy'] == 'priceDesc') {
                $products = $products->where(['status' => 'active'])->orderBy('offer_price', 'DESC');
            }
            if ($_GET['sortBy'] == 'discAsc') {
                $products = $products->where(['status' => 'active'])->orderBy('price', 'ASC');
            }
            if ($_GET['sortBy'] == 'discDesc') {
                $products = $products->where(['status' => 'active'])->orderBy('price', 'DESC');
            }
            if ($_GET['sortBy'] == 'titleAsc') {
                $products = $products->where(['status' => 'active'])->orderBy('title', 'ASC');
            }
            if ($_GET['sortBy'] == 'titleDesc') {
                $products = $products->where(['status' => 'active'])->orderBy('title', 'DESC');
            }
            if ($_GET['sortBy'] == 'newest') {
                $products = $products->where(['status' => 'active', 'condition' => 'new']);
            }
        }

        if (!empty($_GET['price'])) {
            $price = explode('-', $_GET['price']);
            $products->whereBetween('offer_price', $price);
        }

        $products = $products->where('status', 'active')->paginate(12);

        return $products;
    }

    public function productFilter(Request $request)
    {
        $data = $request->all();

        // category url
        $catUrl = '';
        if (!empty($data['category'])) {
            foreach ($data['category'] as $category) {
                if (empty($catUrl)) {
                    $catUrl .= '&category=' . $category;
                } else {
                    $catUrl .= ',' . $category;
                }
            }
        }

        // sort filter
        $sortByUrl = '';
        if (!empty($data['sortBy'])) {
            $sortByUrl .= '&sortBy=' . $data['sortBy'];
        }

        // size filter
        $sizeUrl = '';
        if(!empty($data['size'])) {
            $sizeUrl .= '&size=' . $data['size'];
        }

        // price filter
        $price_range_url = '';
        if (!empty($data['price_range'])) {
            $price_range_url .= '&price=' . $data['price_range'];
        }

        // brand filter
        $brandURL = '';
        if (!empty($data['brand'])) {
            foreach ($data['brand'] as $brand) {
                if (empty($brandURL)) {
                    $brandURL .= '&brand=' . $brand;
                } else {
                    $brandURL .= ',' . $brand;
                }
            }
        }

        return redirect()->route('products', $catUrl . $sortByUrl . $price_range_url . $brandURL . $sizeUrl);
    }


    // public function autoSearch(Request $request)
    // {
    //     $query = $request->get('term', 'all');
    //     $products = Product::where('title', 'LIKE', '%' . $query . '%')->get();

    //     $data = array();
    //     foreach ($products as $product){
    //         $data[] = array('value' => $product->title, 'id' => $product->id);
    //     }

    //     if(count($data)){
    //         return $data;
    //     }else{
    //         return['value' => 'No Result Found', 'id' => ''];
    //     }
    // }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('title', 'LIKE', '%' . $query . '%')
                    ->where('status', 'active')
                    ->orderBy('id', 'DESC')->paginate(12);
        $categories = Category::where(['status' => 'active', 'is_parent' => 1])->with('products')->orderBy('title', 'Asc')->get();
        $brands = Brand::where(['status' => 'active'])->with('products')->get();
        return view('frontend.pages.product.product-grid', compact('products', 'categories', 'brands'));
    }

    public function productCategory(Request $request, $slug)
    {
        $categories = Category::with('products')->where('slug', $slug)->firstOrFail();

        $sort = '';

        if ($request->sort != null) $sort = $request->sort;

        if ($categories == null) {
            return view('errors.404');
        } else {
            if ($sort == 'priceAsc') {
                $sort_products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('offer_price', 'ASC')->paginate(12);
            } elseif ($sort == 'priceDesc') {
                $sort_products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('offer_price', 'DESC')->paginate(12);
            } elseif ($sort == 'discAsc') {
                $sort_products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('price', 'ASC')->paginate(12);
            } elseif ($sort == 'discDesc') {
                $sort_products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('price', 'DESC')->paginate(12);
            } elseif ($sort == 'titleAsc') {
                $sort_products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('title', 'ASC')->paginate(12);
            } elseif ($sort == 'titleDesc') {
                $sort_products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('title', 'DESC')->paginate(12);
            } elseif ($sort == 'newest') {
                $sort_products = Product::where(['status' => 'active', 'cat_id' => $categories->id, 'condition' => 'new'])->paginate(12);
            } else {
                $sort_products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->paginate(12);
            }
        }

        $route = 'product-category';
        return view('frontend.pages.product.product-category', compact('categories', 'route', 'sort_products'));
    }

    public function productDetails($slug)
    {
        $product = Product::with(['related_products', 'product_attributes', 'product_reviews'])->where('slug', $slug)->firstOrFail();
        // return $product;
        return ($product)
            ? view('frontend.pages.product.product-details', compact('product'))
            : 'Product not found';
    }
}
