<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $products = Product::get()->take(4);
    return view('index')->with('products',$products);
})->name('home');

Route::get('/add-product',function(){
    return view('products');
})->name('add-product');

Route::post('/add-product',function(Request $request){
    
    try {
        $data = $request->only(['name','price','description','image']);
        
        $name = $data['name'];
        $price = $data['price'];
        $description = $data['description'];
        
        
        if ($request->hasFile('image')) {
            $images = $request->file('image');
            $uploadedImages = [];
            
            $product = new Product();
            $product->name = $name;
            $product->price = $price;
            $product->description = $description;
            $count = 0;
            foreach ($images as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads'), $imageName);
                $temp[$count] = ['product_id'=>$product->id,'image'=>$imageName];
                $count++;
            }
            // dd($temp[0]['image']);
            $product->image = $temp[0]['image'];            
            $product->save();
            $product->photos()->createMany($temp);
            return response()->json(['status'=>true]);
        }
    } catch (\Throwable $th) {
        return response()->json(['message'=>$th->getMessage(),'status'=>false]);
    }
    
});

Route::get('/get-products',function(Request $request){

    $products = Product::get();
    return view('shop')->with('products',$products);
})->name('products');

Route::get('/product/{id}',function(Request $request){
    $product = Product::with('photos')->where('id','=', $request->id)->first();
    $products = Product::get()->take(4);
    return view('product')->with(['product'=>$product,'products'=>$products]); 
});

Route::get('/about-us',function(){
    return view('aboutus');
})->name('aboutus');

Route::get('/contact-us',function(){
    return view('contact');
})->name('contact');