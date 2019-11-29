<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ListProduct;
use Illuminate\Http\Request;

class ListProductController extends Controller
{
    private $listProduct;

    public function __construct(ListProduct $listProduct)
    {
        $this->listProduct = $listProduct;
    }

    public function index()
    {
        $data['list_products'] = $this->listProduct->all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $data = array();
        $nameFile = null;
        if ($request->hasFile('image')) {
            $name = md5(time() + rand(0, 100000) + rand(0, 500000));
            $extension = $request->image->extension();

            $nameFile = $name . "." . $extension;

            $request->image->storeAs('products', $nameFile);
            $requestData = $request->all();
            $requestData['image'] = $nameFile;
        }
        try {
            $listProduct = $requestData;
            $this->listProduct->create($listProduct);

            $data['msg'] = "Produto Adicionado com sucesso!";
            return response()->json($data);
        } catch (\Throwable $th) {
            $data['msg'] = $th->getMessage();
            return response()->json($data);
        }
    }

    public function show(ListProduct $id)
    {
        $data = ['list_product' => $id];
        return response()->json($data);
    }

    public function update(Request $request, ListProduct $id)
    {
        $data = array();
        try {
            $data = $request->all();
            $id->update($data);
            $data['msg'] = "Produto ". $id->name ." editado com sucesso!";
            return response()->json($data);
        } catch (\Throwable $th) {
            $data['msg'] = $th->getMessage();
            return response()->json($data);
        }
    }

    public function destroy(ListProduct $id)
    {
        $data = array();
        try {
            $id->delete();
            $data['msg'] = "Produto deletado com sucesso!";
            return response()->json($data);
        } catch (\Throwable $th) {
            $data['msg'] = $th->getMessage();
            return response()->json($data);
        }
    }

    public function search($name, Request $request)
    {
        $id = $request->input('id');
        $search = $this->listProduct->where('name', $name)->get();
        $data = ['list_product' => $search->where('id_list', $id)];
        return response()->json($data);
    }
}
