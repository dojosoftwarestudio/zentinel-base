<?php

namespace App\Http\Controllers\SIRIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SIRIN\Category;

use App\Http\Resources\SIRIN\CategoriaResource;

class CategoryController extends Controller
{
    public function list(){
        $list = Category::all();
        return response()->json(['data' => CategoriaResource::collection($list)],200);
    }
    public function listBy(Request $req){
        $filter = $req->filter;
        $value = $req->value;
        $list = Category::where($filter, $value)->get();
        return response()->json(['list'=> $list, 'count' => count($list)],200);
    }
    public function store(Request $req){
        $category = Category::create($req->all());
        return response()->json(['category' => $category],200);
    }

    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
        return response()->json(['msg' => 'Borrado exitoso'],200);
    }
}
