<?php

namespace App\Http\Controllers\Api;

use App\Listbuy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListbuyController extends Controller
{
    private $listbuy;

    public function __construct(Listbuy $listbuy)
    {
        $this->listbuy = $listbuy;
    }

    public function index()
    {
        $data = ['lists' => $this->listbuy->all()];
        return response()->json($data);
    }

    public function store(Request $request)
    {
        try {
            $listbuy = $request->all();
            $this->listbuy->create($listbuy);
            $data = ['msg' => 'Salvo com sucesso!'];
            return response()->json($data);
        } catch (\Throwable $th) {
            $data = ['msg' => $th->getMessage()];
            return response()->json($data);
        }
    }

    public function show($id)
    {
        $listbuy = $this->listbuy->findOrFail($id);
        $data = ['data' => $listbuy->with('listProduct')->where('id', $id)->get()];

        return response()->json($data);
    }

    public function update(Request $request, Listbuy $id)
    {
        $data = array();
        try {
            $data = $request->all();
            $id->update($data);
            $data['msg'] = "Produto editado com sucesso!";
            return response()->json($data);
        } catch (\Throwable $th) {
            $data['msg'] = $th->getMessage();
            return response()->json($data);
        }
    }

    public function destroy(Listbuy $id)
    {
        $data = array();
        try {
            $id->delete();
            $data['msg'] = "Produto removido com sucesso!";
            return response()->json($data);
        } catch (\Throwable $th) {
            $data['msg'] = $th->getMessage();
            return response()->json($data);
        }
    }
}
