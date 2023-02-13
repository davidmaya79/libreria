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
        return view('sexos.create');
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
            'descripcion' => 'required|min:3|max:100|unique:lib_sexo'
        ]);

        Sexo::create($request->all());

        return redirect()
                ->route('sexos.index')
                ->with('success','Sexo registrado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sexo  $sexo
     * @return \Illuminate\Http\Response
     */
    public function show(Sexo $sexo)
    {
        return view('sexos.show', ['sexo' => $sexo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sexo  $sexo
     * @return \Illuminate\Http\Response
     */
    public function edit(Sexo $sexo)
    {
        return view('sexos.edit',['sexo'=> $sexo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sexo  $sexo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sexo $sexo)
    {
        $request->validate([
            'descripcion' => 'required|min:3|max:100|unique:lib_sexo,descripcion,'.$sexo->cod_sexo.',cod_sexo'
        ]);

        $sexo->fill($request->only([
            'descripcion'
        ]));

        if($sexo->isClean()){
            return back()->with('mensajedeadvertencia','Debe realizar al menos un cambio para actualizar.');
        }
        $sexo->update($request->all());
        return back()->with('mensajedeexito','Sexo Actualizado Correctamemte.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sexo  $sexo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sexo $sexo)
    {
        $sexo->delete();
        return redirect()->route('sexos.index');
    }
}
