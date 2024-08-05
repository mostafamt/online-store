<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Admin Page - Products - Online Store";
        $viewData["products"] = Product::all();
        return view('admin.product.index')->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|max:255",
            "description" => "required",
            "price" => "required|numeric|gt:0",
            'image' => 'image',
        ]);

        $creationData = $request->only(["name", "description", "price"]);
        $creationData["image"] = "game.png";
        $creationData["created_at"] = time();
        $creationData["updated_at"] = time();

        $product = new Product();
        $product->exchangeArray($creationData);
        $product->save();

        return back();
    }
}