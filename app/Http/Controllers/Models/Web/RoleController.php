<?php

namespace App\Http\Controllers\Models\Web;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('role.index', [
            'roles' => Role::paginate(10)
        ]);
    }

    public function indexNameAscending()
    {
        return view('role.index', [
            'roles' => Role::orderBy('name', 'asc')->paginate(10)
        ]);
    }

    public function indexNameDescending()
    {
        return view('role.index', [
            'roles' => Role::orderBy('name', 'desc')->paginate(10)
        ]);
    }

    public function indexEmailAscending()
    {
        return view('role.index', [
            'roles' => Role::orderBy('email', 'asc')->paginate(10)
        ]);
    }

    public function indexEmailDescending()
    {
        return view('role.index', [
            'roles' => Role::orderBy('email', 'desc')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = new Role;
        $role->name = $request->name;
        $role->save();

        return redirect()->route('role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return view('role.edit', [
            'role' => Role::find($request->id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $role = Role::find($request->id);
        $role->name = $request->name;
        $role->save();

        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $role = Role::where('id', $request->id);
        $role->delete();

        return redirect()->route('role.index');
    }
}
