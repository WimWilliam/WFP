<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Menggunakan model
        $rs = Type::all();

        return view('type.index', compact('rs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('type.formcreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        //type_name dari name yang ada di form
        $data = new Type();
        $data->name = $request->type_name;
        $data->save();
        return redirect()->route("type.index")->with("status", "Data baru berhasil tersimpan");
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        // dd($type);
        $data = $type;

        return view("type.formedit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        // //$type->name dari field database
        // echo "nama lama = " . $type->name;

        // //$request->type_name dari name pada inputan
        // echo "<br>nama baru = " . $request->type_name;
        $updatedData = $type;
        $updatedData->name = $request->type_name;
        $updatedData->save();
        return redirect()->route('type.index')->with('status','Horray ! Your data is successfully updated !');

    }

    /**
     * Remove the specified resource from storage.
     */

     //DELETE
    public function destroy(Type $type)
    {
        $user=Auth::user();
        $this->authorize('delete-permission',$user);
          
        $deletedData = $type;
        try {
                    //if no contraint error, then delete data. Redirect to index after it.
                    $deletedData = $type;
                    $deletedData->delete();
                    return redirect()->route('type.index')->with('status','Horray ! Your data is successfully deleted !');
        } catch (\PDOException $ex) {
                    // Failed to delete data, then show exception message
                    $msg = "Failed to delete data ! Make sure there is no related data before deleting it";
                    return redirect()->route('type.index')->with('statusError',$msg);
        }
            
        dd($deletedData);
    }
    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Type::find($id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('type.getEditForm', compact('data'))->render()
        ),200);
    }

    public function getEditFormB(Request $request)
    {
        $id = $request->id;
        $data = Type::find($id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('type.getEditFormB', compact('data'))->render()
        ),200);
    }

    public function saveDataTD(Request $request)
    {
        $id = $request->id;
        $data = Type::find($id);
        $data->name = $request->name;
        $data->save();
        return response()->json(array(
                    'status' => 'oke',
                    'msg' => 'type data is up-to-date !'
        ),200);
    }

    public function deleteData(Request $request)
    {
            $id = $request->id;
            $data = Type::find($id);
            $data->delete();
            return response()->json(array(
                  'status' => 'oke',
                  'msg' => 'type data is removed !'
            ),200);
    }



}
