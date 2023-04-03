<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Cart_order1;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;


class Product_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);
      
        return view('products.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'quantity'=> 'required',
            'image' =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        if($request->file('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/books'), $imageName);
    
            $data= array(
                'name'=> $request->name,
               'quantity'=> $request->quantity,
               'price'=> $request->price,
               'image' => $imageName
               
           );
        }
        else{
            $data= array(
                'name'=> $request->name,
               'quantity'=> $request->quantity,
               'price'=> $request->price,
               );
        }    
        Product::create($data);
       
        return redirect()->route('products.index')
                        ->with('success','Books added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'quantity'=> 'required',
            'image' =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $id= $product->id;
        $old_image= $request->old_image;

        if ($image = $request->file('image')) {          
          $imageName1 = time().'.'.$request->image->extension();
          $request->image->move(public_path('images/books'), $imageName1);
          $imagePath = public_path('images/books/'.$old_image);
          if(file_exists($imagePath)){
             unlink( $imagePath);
          }
          else{
              return redirect()->route('products.edit')
              ->with('error','unable to upload file.');
          }
        
      }else{
          $imageName1= $old_image; 
      }
        $data= array(        
            'name'=> $request->name,
            'quantity'=> $request->quantity,
            'price'=> $request->price,
            'image' => $imageName1
            
        );

      DB::table('products')->where('id', $id)->update($data);
        return redirect()->route('products.index')->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Product::where('id', $product->id)->delete();
        return redirect()->route('products.index')  
                        ->with('success','Books deleted successfully');
    }


    public function trash(){
        $products = Product::onlyTrashed()->paginate(5);

        return view('products.recycle_bin', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    
    }
    public function restore($id){
        $products = Product::where('id', $id)->withTrashed()->first();
        $products->restore();
        return redirect()->route('Trash')
            ->with('success', 'You successfully restored the ');
    }

    public function permanent_delete(Request $request){
        $id=$request->id;
        $image1= DB::table('products')->where('id',$id)->get();
        $imagePath = public_path('images/books/'.$image1[0]->image);
        if(file_exists($imagePath)){
           unlink( $imagePath);
        }
        $products = Product::where('id', $id)->withTrashed()->first();
        $products->forceDelete();
        return redirect()->route('products.index')
            ->with('success', 'You successfully deleted the book from  Recycle Bin');

    }
    public function see_all_products()
    {
        $products = Product::all();
      
        return view('products.see_all',compact('products'));
            
    }
    
    public function add_to_cart(Request $request)
    {             
         $data= array(
                'product_id'=> $request->product_id,  
                'user_id'   => Auth::user()->id,         
               );
          $product_exist= Cart::where('product_id',$request->product_id)->where('user_id',Auth::user()->id)->get()->toArray();
           if(empty($product_exist)){
            Cart::create($data);
           }
           else{
        
             $product_id=  $request->product_id;
             $user_id= Auth::user()->id;
        //   $q=  Cart_order1::where('user_id',$user_id)->where('product_id',$product_id)->toSql();increment('order_quantity',1);
         
        //   dd($q);
      
      
           }
           
        return redirect()->back()
                        ->with('success','Added to Cart Successfully.');
    }

    public function cart_page()
    {
        $id= Auth::user()->id; 
    	$products = Cart::where('user_id',$id)->join('products', 'cart.product_id', '=', 'products.id')
              		->get()->toArray();
                     
        return view('products.cart_page',compact('products'));

    }
    public function delete_cart_product(Request $request){
       
        $data= array(
            'product_id'=> $request->product_id,
           'user_id'=> Auth::user()->id,
          
       );
       Cart::where($data)->delete();

        return json_encode(array(
            "statusCode"=>200
        ));
    }

    public function get_cart_data(){
        $id= Auth::user()->id; 
    	$products = Cart::join('products', 'cart.product_id', '=', 'products.id')->get();
        
        return json_encode(array(
            "statusCode"=>200,
            "data"      =>$products
        ));

    }

    // update the quantity in cart 

    public function update_quantity(Request $request){
      
        $data= array(
            'product_id'=> $request->product_id,
            'user_id'=> Auth::user()->id,    
       );
       $data1= array('cart_quantity'=> $request->quantity);
       $quantity= $request->quantity;
       $data= DB::table('cart')->where($data)->update($data1);
       return json_encode(array(
        "statusCode"=>200
    ));

    }

    public function order_history_page(Request $request){
        $user_id   = Auth::user()->id;
        $user = User::firstWhere('id', $user_id);
        $search= $request->get('search');

    if($user->role_id==2){
        if(!empty($search)){
            $data = DB::table('cart_order1')
            ->where('cart_order1.user_id' ,'=', $user_id)
            ->join('products', 'cart_order1.product_id', '=', 'products.id')
            ->where('products.name', 'LIKE', '%'.$search.'%')
            ->orWhere('cart_order1.price', 'LIKE','%'.$search.'%')  
            ->paginate(5);
      
        }      
        else{
            $data =Cart_order1::where('user_id',$user_id)->join('products', 'cart_order1.product_id', '=', 'products.id')->paginate(5);
        }
        return view('products/order_history_page')->with('orders',$data);
    }    
    else{  
            if(!empty($search)){
                $data =Cart_order1::where('cart_order1.price', 'LIKE', '%'.$search.'%')->orWhere('products.name', 'LIKE', '%'.$search.'%')
                ->join('products', 'cart_order1.product_id', '=', 'products.id')   
                ->join('users', 'cart_order1.user_id', '=', 'users.id')
                ->select('products.*', 'users.name as username', 'cart_order1.order_quantity as  ordered_quantities','cart_order1.created_at as order_date','cart_order1.pdf_invoice as pdf','cart_order1.payment_method','cart_order1.payment_status as payment' )
                ->paginate(5);
             
               }
            else{
                
                $data =Cart_order1::join('products', 'cart_order1.product_id', '=', 'products.id')
                ->join('users', 'cart_order1.user_id', '=', 'users.id')
                ->select('products.*', 'users.name as username', 'cart_order1.order_quantity as  ordered_quantities','cart_order1.created_at as order_date','cart_order1.payment_status as payment','cart_order1.pdf_invoice as pdf','cart_order1.payment_method' )
                ->paginate(5);
                // echo '<pre>';
                // print_r($data);die;
              
                    return view('products/order_history_page_admin')->with('orders',$data);
                    
            }
            return view('products/order_history_page_admin')->with('orders',$data);
      
    }
       
    }

    public function generate_order_bill()
    {
        $pdf = PDF::loadView('pdf/myPDF');
        
        // return $pdf->download('bill.pdf');
    }

    public function welcome_page(){
     
        $products = Product::latest()->paginate(5);
        return view('test/test_welcome_page',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
           
        }
}

   

