<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\File;


class ProductController extends Controller
{

    public function index(Request $request)
    {
        //Menggunakan Raw Query atau DB raw
        //$rs = data array atau data yang ada di database.
        // $rsProduct = DB::select("select* from hotels");

        //Mengecek Data seperti json
        // dd($rs);

        //Menggunakan Query Builder
        // $rsProduct = DB::table('hotels')
        //     ->where('name','like','%nor%')
        //     ->get();

        //Menggunakan model

        
        // $rsProduct = Product::all();
        // foreach($rsProduct as $r)
        // {
        //     $directory = public_path('product/'.$r->id);
        //     if(File::exists($directory))
        //     {
        //        $files = File::files($directory);
        //        $filenames = [];
        //        foreach ($files as $file) {
        //           $filenames[] = $file->getFilename();
        //        }
        //        $r['filenames']=$filenames;
        //     }
        // }
     
        // dd($rsProduct);
        //Melempar ke halaman view index.blade.php (['rsProduct'] => $rs) 
        // return view('product.index', compact('rsProduct'));
        $keyword = $request->input('search');
    
        // Query semua produk atau filter berdasarkan pencarian
        $query = Product::query();
        
        if (!empty($keyword)) {
            $query->where('name', 'LIKE', '%' . $keyword . '%');
        }
    
        $rsProduct = $query->get();
    
        foreach ($rsProduct as $r) {
            $directory = public_path('product/' . $r->id);
            if (File::exists($directory)) {
                $files = File::files($directory);
                $filenames = [];
                foreach ($files as $file) {
                    $filenames[] = $file->getFilename();
                }
                $r['filenames'] = $filenames;
            }
        }
    
        return view('product.index', compact('rsProduct'));
    }

    public function create()
    {
        return view('product.formcreate');
    }


    public function store(Request $request)
    {

        $data = new Product();
        //Request->name dari sebuah inputan
        $data->name = $request->products_name;
        $data->price = $request->products_price;
        $data->hotel_id = $request->hotels_id;
        $data->available_room = $request->products_available;
        $data->save();
        return redirect()->route("products.index")->with("status", "Data baru berhasil tersimpan");
    }


    public function show(Product $product)
    {
        echo $product->name;
    }


    // public function edit(Hotel $hotel)
    // {
        
    // }
    
    public function edit(Product $product)
    {
        $data = $product;
        return view("product.formedit", compact('data'));
    }

    public function update(Request $request, Product $product)
    {
        $updatedData = $product;
        $updatedData->name = $request->products_name;
        $updatedData->price = $request->products_price;
        $updatedData->save();
        return redirect()->route('products.index')->with('status','Horray ! Your data is successfully updated !');
    }
    // public function update(Request $request, Hotel $hotel)
    // {
        
    // }
    public function averagePrice() 
    {
        $dataPrice = Product::join('hotels as h', 'products.id', '=', 'h.hotel_type')
        ->select('products.name as name', 'h.name as namahotel', DB::raw("avg(products.price) as 'price'"))
        ->groupBy('products.id', 'products.name', 'h.name', 'products.price')
        ->get();

        return view('hotel.averagePrice', compact('dataPrice'));
    }


    // public function destroy(Hotel $hotel)
    // {

    // }
    public function destroy(Product $product)
    {
        $deletedData = $product;
        try {
                    //if no contraint error, then delete data. Redirect to index after it.
                    $deletedData = $product;
                    $deletedData->delete();
                    return redirect()->route('products.index')->with('status','Horray ! Your data is successfully deleted !');
        } catch (\PDOException $ex) {
                    // Failed to delete data, then show exception message
                    $msg = "Failed to delete data ! Make sure there is no related data before deleting it";
                    return redirect()->route('products.index')->with('statusError',$msg);
        }
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Product::find($id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('product.getEditForm', compact('data'))->render()
        ),200);
    }


    public function uploadPhoto(Request $request)
    {
        $product_id=$request->product_id;
        $product=Product::find($product_id);
        return view('product.formUploadPhoto',compact('product'));
    }

    public function simpanPhoto(Request $request)
    {
        $file=$request->file("file_photo");
        $folder='product/'.$request->product_id;
        @File::makeDirectory(public_path()."/".$folder);
        $filename=time()."_".$file->getClientOriginalName();
        $file->move($folder,$filename);
        $product = $request->input('product_name');
        return redirect()->route('products.index')->with('status','photo terupload');
    }

    public function delPhoto(Request $request)
    {
        File::delete(public_path()."/".$request->filepath);
        return redirect()->route('products.index')->with('status','photo dihapus');
    }

    

}
