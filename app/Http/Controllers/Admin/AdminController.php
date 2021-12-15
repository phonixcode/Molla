<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display dashboard of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('admin.dashboard.index', [
            'products'      => Product::getActiveProduct(),
            'categories'    => Category::getActiveCategories(),
            'users'         => User::getActiveUsers(),
            'orders'        => Order::getLatestOrders()
        ]);
    }
}
