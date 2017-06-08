<?php

namespace App\Http\Controllers\Models\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreUpdateRoleRequest;
use App\Http\Requests\Route\EditDeleteRouteRequest;
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

    public function search()
    {
        return view('role.search', [
            'roles' => Role::all()
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
     * @param StoreUpdateRoleRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateRoleRequest $request)
    {
        $role = new Role;
        $role->name = $request->name;
        $role->save();

        return redirect()->route('role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param EditDeleteRouteRequest $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(EditDeleteRouteRequest $request)
    {
        return view('role.edit', [
            'role' => Role::find($request->id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateRoleRequest|Request $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(StoreUpdateRoleRequest $request)
    {
        $role = Role::find($request->id);
        $role->name = $request->name;
        $role->save();

        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param EditDeleteRouteRequest $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(EditDeleteRouteRequest $request)
    {
        $role = Role::where('id', $request->id);
        $role->delete();

        return redirect()->route('role.index');
    }
}
