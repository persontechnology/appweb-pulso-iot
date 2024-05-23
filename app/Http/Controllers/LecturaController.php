<?php

namespace App\Http\Controllers;

use App\DataTables\LecturaDataTable;
use App\Models\Lectura;
use Illuminate\Http\Request;

class LecturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LecturaDataTable $dataTable)
    {
        return $dataTable->render('lecturas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $lectura=Lectura::find($id);
            $lectura->delete();
            return redirect()->route('lecturas.index')->with('success','Lectura eliminado.!');
        } catch (\Throwable $th) {
            return redirect()->route('lecturas.index')->with('danger','Lectura no eliminado.!');
        }
    }
}
