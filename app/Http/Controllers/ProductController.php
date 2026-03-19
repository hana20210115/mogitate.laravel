<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
      public function index(Request $request)
    {
        $query = Product::with('seasons');

        $search = $request->search;
        if ($search) {
            $query->where('name', 'like', "%{$search}%");}

        if($request->sort === 'asc'){
        $query->orderBy('price', 'asc');}
        elseif($request->sort === 'desc'){
        $query->orderBy('price', 'desc');}

        $products = $query->paginate(6);

        
        return view('index', compact('products', 'search'));
    }
    

    public function show($id)
    {
        $product = Product::with('seasons')->findOrFail($id);
        $seasons = \App\Models\Season::all();
        return view('show', compact('product','seasons'));
    }

    public function update(ProductRequest $request, $id)
    {

    $data = $request->validated();
    $product = Product::findOrFail($id);

    if($request->hasFile('image')){
        $filename = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('products', $filename, 'public');
        $data['image'] = $filename;
    } else
    {
        $data['image'] = $product->image;
    }

    $product->update([
        'name' => $data['name'],
        'price' => $data['price'],
        'description' => $data['description'],
        'image' => $data['image'] ,
    ]);

    if ($request->has('seasons')) {
        $product->seasons()->sync($request->seasons);
    }

   
    return redirect()->route('index')->with('success', '商品を更新しました！');
}

public function create()
{
$seasons = \App\Models\Season::all();
return view('create', compact('seasons'));


 }

 public function store(ProductRequest $request)
 {
    $data = $request->validated();
    $filename = 'noimage.jpg';
   
    if($request->hasFile('image')){
        $filename = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('products', $filename, 'public');
        $data['image'] = $filename;
    } 
   
   $product = Product::create([

   'name' => $data['name'],
   'price' => $data['price'],
   'description' => $data['description'],
   'image' => $filename,
   ]);
 
 if($request->has('seasons')){
    $product->seasons()->attach($request->seasons);
 }
 
 return redirect()->route('index')->with('success', '商品を登録しました！');
 
    }
  public function destroy($id)
  {
     $product = Product::findOrFail($id);
     $product->seasons()->detach();
     
     if ($product->image) {
    \Storage::disk('public')->delete('products/' . $product->image);
}
     
     $product->delete();
     return redirect()->route('index')->with('success', '商品を削除しました！');

  }





}