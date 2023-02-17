<?php

namespace App\Http\Controllers;

use App\Models\Idioma;
use Illuminate\Http\Request;

class IdiomaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idiomas = Idioma::orderBy('cod_idioma','ASC')->get();
        return view('idiomas.index',[ 'idiomas' => $idiomas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('idiomas.create');
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
            'descripcion' => 'required|min:3|max:100|unique:lib_idioma'
        ]);

        Idioma::create($request->all());

        return redirect()
                ->route('idiomas.index')
                ->with('success','Idioma registrado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sexo  $sexo
     * @return \Illuminate\Http\Response
     */
    public function show(Idioma $idioma)
    {
        return view('idiomas.show', ['idioma' => $idioma]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sexo  $sexo
     * @return \Illuminate\Http\Response
     */
    public function edit(Idioma $idioma)
    {
        return view('idiomas.edit',['idioma'=> $idioma]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sexo  $sexo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Idioma $idioma)
    {
        $request->validate([
            'descripcion' => 'required|min:3|max:100|unique:lib_idioma,descripcion,'.$idioma->cod_idioma.',cod_idioma'
        ]);

        $idioma->fill($request->only([
            'descripcion'
        ]));

        if($idioma->isClean()){
            return back()->with('warning','Debe realizar al menos un cambio para actualizar.');
        }
        $idioma->update($request->all());
        return back()->with('success','Idioma Actualizado Correctamemte.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sexo  $sexo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Idioma $idioma)
    {
        $idioma->delete();
        return back()->with('danger','Idioma Eliminado Correctamente.');
    }
}
