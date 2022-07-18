<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\NavbarTrait;
use App\Category;
use App\Product;

class CategoryController extends Controller
{
     public function index()
    {

        $categories = Category::all();
        $products = Product::with(['galleries'])->paginate(32);
        $total_notif = NavbarTrait::total_notif();
        $list_notif_display = NavbarTrait::list_notif_display();
        $notif_pesan = NavbarTrait::notif_pesan();
        $notif_group = NavbarTrait::notif_group();
        return view('pages.category', compact('categories', 'total_notif', 'products' ,'list_notif_display', 'notif_pesan', 'notif_group'));
    }
      public function detail(Request $request, $slug)
    {
        $products = Product::with(['galleries'])->paginate(32);
        $total_notif = NavbarTrait::total_notif();
        $list_notif_display = NavbarTrait::list_notif_display();
        $notif_pesan = NavbarTrait::notif_pesan();
        $notif_group = NavbarTrait::notif_group();
        $categories = Category::all();
        $category = Category::where('slug',$slug)->firstOrFail();
        $products = Product::with(['galleries'])->where('categories_id',$category->id)->paginate(32);
        return view('pages.category',
            [
                'categories'=> $categories,
                'products'=> $products,
                'total_notif' => $total_notif,
                'notif_pesan' => $notif_pesan,
                'list_notif_display' => $list_notif_display,
                'notif_grup' => $notif_group
            ]);
    }
}
