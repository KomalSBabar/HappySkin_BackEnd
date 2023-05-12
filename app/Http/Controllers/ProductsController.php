<?php

namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\Products;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class ProductsController extends Controller
{
  
    public function index(){
        $products = Products::get();
    //view call
        return view('product.index')->with(compact('products'));
    }
    public function create(){
    
        return view('product.create');
    }
    public function store(Request $request){
        $imageName = $request->file('image_url')->getClientOriginalName();  
     
        $request->image_url->move(public_path('image'), $imageName);

        $data = [
            'title'=>$request->title,
            'image_url'=>$imageName,
            'price'=>$request->price,
            'short_desc'=>$request->short_description,
            'detail'=>$request->detail,
            'avail_qty'=>$request->avail_qty,
            'category'=>$request->category
         
        ];
       

        $product = Products::create($data);
       
        if($product)
        {
            return redirect()->route('product.index');
        }
        else
        {
            return;
        }
    } 
    
    public function edit_pro($product_id){
        $post = Products::find($product_id);
        return view('product.edit', compact('post'));
    }

    public function update_pro( Request $request ,$post_id){
        // $data = $request->all();
        
        $post = Products::find($post_id);
        if($request->has('image_url'))
        {

            $imageName = $request->file('image_url')->getClientOriginalName(); 
            $request->image_url->move(public_path('image'), $imageName);
          
          

            $post->title = $request['title'];
            $post->image_url =$imageName;
            $post->price = $request['price'];
            $post->short_description = $request['short_desc'];
            $post->detail = $request['detail'];
            $post->avail_qty = $request['avail_qty'];
            $post->category = $request['category'];
            $post->update();

        }
        else {
            $post->title = $request['title'];
            $post->price = $request['price'];
            $post->short_description = $request['short_desc'];
            $post->detail = $request['detail'];
            $post->avail_qty = $request['avail_qty'];
            $post->category = $request['category'];
            $post->update();
        }
        return redirect()->route('product.index')   ;

    }

    public function destroy($id)
    {
       
        
        $tech = Products::where('id',$id)->delete();
        

        return redirect()->route('product.index')
                        ->with('success','Product deleted successfully');

    }


}
