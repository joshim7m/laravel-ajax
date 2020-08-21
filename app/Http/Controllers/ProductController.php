<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function getProducts()
    {
    	$products = Product::latest()->paginate(10);
    	return view('product.index', compact('products'));
    }

    public function getAjaxProducts()
    {
    	$products = Product::latest()->paginate(10);
    	return view('product.products', compact('products'));
    }
}
