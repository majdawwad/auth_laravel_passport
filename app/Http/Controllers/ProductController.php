<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $user_id=$request->user()->id;
        $products=Product::where('user_id',$user_id)->get();
        return response()->json(['products'=>$products],200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:255',
            'description'=>'required|max:255',
        ]);

        $product=Product::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'user_id'=>$request->user()->id,
        ]);

        return response()->json([
            'message'=>'product created succesfully',
            'product'=>$product,
        ],201);

    }

    public function show(Request $request, $id)
    {
        $user_id=$request->user()->id;
        $product=Product::where('user_id',$user_id)->find($id);
        if(!$product){
            return response()->json(['product'=>'Not found'],404);
        }
        return response()->json(['product'=>$product],200);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required|max:255',
            'description'=>'required|max:255',
        ]);

        $user_id=$request->user()->id;
        $product=Product::where('user_id',$user_id)->find($id);

        if(!$product){
            return response()->json(['product'=>'Not found'],404);
        }

        $product->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'user_id'=>$request->user()->id
        ]);

        return response()->json([
            'message'=>'product updated succesfully',
            'product'=>$product,
        ],200);


    }

    public function destroy(Request $request, $id)
    {
        $user_id=$request->user()->id;
        $product=Product::where('user_id',$user_id)->find($id);

        if(!$product){
            return response()->json(['product'=>'Not found'],404);
        }

        $product->delete($id);

        return response([
            'message'=>'Product deleted sucessfully'
        ],200);
    }
}
