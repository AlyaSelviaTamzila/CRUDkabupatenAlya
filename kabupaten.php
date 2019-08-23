<?php

namespace App\Http\Controllers;
use App\modelKabupaten;
use Illuminate\Http\Request;
use Validator;

class kabupaten extends Controller{
  public function index(){
    $data = modelKabupaten::all();
    return view('kabupaten', compact('data'));
    // return view('newkontak', compact('data'));
  }

  public function create(){
    return view('kabupaten_create');
  }

  public function store(Request $request){
    $this->validate($request,[
      'code' => 'required',
      'description' => 'required',
    ]);
 
    $data = new modelKabupaten();
    $data->code = $request->code;
    $data->description = $request->description;
    $data->save();

    return redirect()->route('kabupaten.index')->with('alert_message', 'Berhasil menambah data!');
  }

  public function edit($id)
  {
    $data = modelKabupaten::where('id', $id)->get();
    return view('kabupaten_edit', compact('data'));
  }

  public function update(Request $request, $id)
  {
      $this->validate($request, [

      'code' => 'required',
      'description' => 'required',
      ]);

      $data = modelKabupaten::where('id', $id)->first();
      $data->code = $request->code;
      $data->description = $request->description;
      $data->save();

      return redirect()->route('kabupaten.index')->with('alert_message', 'Berhasil mengubah data data!');
  }

  public function destroy($id)
  {
    $data = modelKabupaten::where('id', $id)->first();
    $data->delete();

    return redirect()->route('kabupaten.index')->with('alert_message', 'Berhasil menghapus data!');
  }

}
