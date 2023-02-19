<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = categoria::orderBy('cod_categoria','DESC')->paginate(5);
        return view('categorias.index',[ 'categorias' => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.create');
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
            'titulo' => 'required|min:3|max:100|unique:lib_categoria'
        ]);

        Categoria::create($request->all());

        return redirect()
                ->route('categorias.index')
                ->with('success','Categoria registrada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sexo  $sexo
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        return view('categorias.show', ['categoria' => $categoria]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sexo  $sexo
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit',['categoria'=> $categoria]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sexo  $sexo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'titulo' => 'required|min:3|max:100|unique:lib_categoria,titulo,'.$categoria->cod_categoria.',cod_categoria'
        ]);

        $categoria->fill($request->only([
            'titulo'
        ]));

        if($categoria->isClean()){
            return back()->with('warning','Debe realizar al menos un cambio para actualizar.');
        }
        $categoria->update($request->all());
        return back()->with('success','Categoria Actualizada Correctamemte.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sexo  $sexo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return back()->with('danger','Categoria Eliminada Correctamente.');
    }
}
