<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Http\Controllers\ProductController;

class HotelController extends Controller
{

    public function index()
    {
        //Menggunakan Raw Query
        //$rs = data array atau data yang ada di database.
        //$rs = DB::select("select* from hotels");

        //Mengecek Data seperti json
        // dd($rs);

        //Menggunakan Query Builder 
        //Untuk menampilkan nama hotel yang memiliki kata south
        $rs = DB::table('hotels')
            ->whereRaw("name like '%south%'")
            ->get();

        // //Menggunakan model
        // $rs = Hotel::all();
        // $rs=Hotel::where('name','like','%nor%')->get();

        //Urut A-Z
        $rs = Hotel::orderBy('name','asc')->get();

        // $rs = Hotel::selectRaw('city,count(id) as jumlah')
        // ->groupBy('City')
        // ->get();

        // $rs = DB::table("hotels")
        // ->selectRaw('city,count(id) as jumlah')
        // ->groupBy('City')
        // ->get();

        // dd($rs);

        // Untuk mengecek jumlah data di table hotels ada berapa totalnya
        // $jum = DB::table("hotels")->count();
        // echo $jum;

        //Melempar ke halaman view index.blade.php (['rs'] => $rs) 
        return view('hotel.index', compact('rs'));
    }

    public function cekproduk(Request $request)
    {
        $id_htl = 0;
        $hotelid = $request->input('hotel_id');
        $idhotel = DB::table('hotels')
        ->where('id', $hotelid)
        ->value('id');


   

        $data = Product::join('hotels as h', 'products.hotel_id', '=', 'h.id')
        ->select('products.id', 'products.name as name', 'products.price as price', 'products.available_room as available_room', 'products.fasilitas as fasilitas', 'products.image as image')
        ->groupBy('products.id', 'products.name', 'products.price', 'products.available_room', 'products.available_room', 'products.fasilitas', 'products.image')
        ->where('products.hotel_id', $idhotel)
        ->get();

        // dd($data);
        return view('product.tampilproduk', compact('data'));
    }


    public function create()
    {
    
    }


    public function store(Request $request)
    {
        
    }


    public function show(Hotel $hotel)
    {
        //Untuk show by id/href
        return view('hotel.show', compact('hotel'));
    }


    public function edit(Hotel $hotel)
    {
        
    }

 
    public function update(Request $request, Hotel $hotel)
    {
        
    }


    public function destroy(Hotel $hotel)
    {
        
    }

    public function availableHotelRoom() 
    {
        //Eloquent model
        //Menggabungkan value pada table hotel dan products
        //DB::raw : query default sql;
        $data = Hotel::join('products as p', 'hotels.id', '=', 'p.hotel_id')
        ->select('hotels.name as hotel', 'hotels.address', 'hotels.city', DB::raw("sum(p.available_room) as 'rooms'"))
        ->groupBy('hotels.id', 'hotels.name', 'hotels.address', 'hotels.city')
        ->get();

        // dd($data);
        return view('hotel.availableRoom', compact('data'));
    }
    public function uploadLogo(Request $request)
    {
        $hotel_id=$request->hotel_id;
        $hotel=Hotel::find($hotel_id);
        return view('hotel.formUploadLogo',compact('hotel'));
    }
    public function simpanLogo(Request $request)
    {
       $file=$request->file("file_logo");
       $folder='logo';
       $filename=$request->hotel_id . ".jpg";
       $file->move($folder,$filename);
       return redirect()->route('hotels.index')->with('status','logo terupload');
    }

    public function simpanPhoto(Request $request)
    {
        $file=$request->file("file_photo");
        $folder='image';
        $filename=time()."_".$file->getClientOriginalName();
        $file->move($folder,$filename);
        $hotel=Hotel::find($request->hotel_id);
        $hotel->image=$filename;
        $hotel->save();
        return redirect()->route('hotels.index')->with('status','photo terupload');
    }

    public function uploadPhoto(Request $request)
    {
        $hotel_id=$request->hotel_id;
        $hotel=Hotel::find($hotel_id);
        return view('hotel.formUploadPhoto',compact('hotel'));
    }


    

}
