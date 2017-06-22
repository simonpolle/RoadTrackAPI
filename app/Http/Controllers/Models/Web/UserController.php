<?php

namespace App\Http\Controllers\Models\Web;


use App\Http\Controllers\Controller;
use App\Http\Requests\User\EditDeleteUserRequest;
use App\Http\Requests\User\StoreUpdateUserRequest;
use App\Models\Company;
use App\Models\Role;
use App\Models\Route;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        if (Auth::user()->role_id == 2)
        {
            $company = Company::where('id', Auth::user()->company_id)->first();
            $users = User::where('company_id', $company->id)->paginate(10);
            return view('user.index', [
                'users' => $users
            ]);
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('user.index', [
                'users' => User::paginate(10)
            ]);
        }
    }

    public function search()
    {
        if (Auth::user()->role_id == 2)
        {
            $users = User::where('company_id', Auth::user()->company_id)->get(10);
            return view('user.search', [
                'users' => $users,
            ]);
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('user.search', [
                'users' => User::all(),
            ]);
        }
    }

    public function indexNameAscending()
    {
        if (Auth::user()->role_id == 2)
        {
            $company = Company::where('id', Auth::user()->company_id)->first();
            $users = User::where('company_id', $company->id)->orderBy('first_name', 'asc')->paginate(10);
            return view('user.index', [
                'users' => $users
            ]);
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('user.index', [
                'users' => User::orderBy('first_name', 'asc')->paginate(10)
            ]);
        }
    }

    public function indexNameDescending()
    {
        if (Auth::user()->role_id == 2)
        {
            $company = Company::where('id', Auth::user()->company_id)->first();
            $users = User::where('company_id', $company->id)->orderBy('first_name', 'desc')->paginate(10);
            return view('user.index', [
                'users' => $users
            ]);
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('user.index', [
                'users' => User::orderBy('first_name', 'desc')->paginate(10)
            ]);
        }
    }

    public function indexEmailAscending()
    {
        if (Auth::user()->role_id == 2)
        {
            $company = Company::where('id', Auth::user()->company_id)->first();
            $users = User::where('company_id', $company->id)->orderBy('email', 'asc')->paginate(10);
            return view('user.index', [
                'users' => $users
            ]);
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('user.index', [
                'users' => User::orderBy('email', 'asc')->paginate(10)
            ]);
        }
    }

    public function indexEmailDescending()
    {
        if (Auth::user()->role_id == 2)
        {
            $company = Company::where('id', Auth::user()->company_id)->first();
            $users = User::where('company_id', $company->id)->orderBy('email', 'desc')->paginate(10);
            return view('user.index', [
                'users' => $users
            ]);
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('user.index', [
                'users' => User::orderBy('email', 'desc')->paginate(10)
            ]);
        }
    }

    public function pdf(Request $request)
    {
        if (Auth::user()->role_id == 2)
        {
            $company = Company::where('id', Auth::user()->company_id)->first();
            $users = User::where('company_id', $company->id)->get();
            view()->share('users', $users);
        }
        else if (Auth::user()->role_id == 3)
        {
            $users = User::all();
            view()->share('users', $users);
        }

        if ($request->has('download'))
        {
            $pdf = PDF::loadView('user.pdf');
            return $pdf->download('users.pdf');
        }

        return view('user.index');
    }

    public function excel()
    {
        if (Auth::user()->role_id == 2)
        {
            $company = Company::where('id', Auth::user()->company_id)->first();
            $users = User::where('company_id', $company->id)->get();
        }
        else if (Auth::user()->role_id == 3)
        {
            $users = User::all();
        }
        Excel::create('users', function ($excel) use ($users)
        {
            $excel->sheet('Sheet 1', function ($sheet) use ($users)
            {
                $sheet->fromArray($users);
            });
        })->download('xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        if (Auth::user()->role_id == 2)
        {
            return view('user.create', [
                'roles' => Role::where('name', '<>', 'admin')->get(),
                'companies' => Company::where('id', Auth::user()->company_id)->get()
            ]);
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('user.create', [
                'roles' => Role::all(),
                'companies' => Company::all()
            ]);
        }
    }

    public function details(EditDeleteUserRequest $request)
    {
        $user = User::find($request->id);
        $routes = Route::where('user_id', $user->id)->whereMonth('created_at', '=', Carbon::now()->month)->get();
        $total_costs = $routes->sum('total_cost');
        $cost_type = "No cost specified";
        if (sizeof($routes) > 0)
        {
            $cost_type = $routes->first()->cost->name;
        }

        return view('user.details', [
            'user' => $user,
            'routes' => $routes,
            'total_costs' => $total_costs,
            'cost_type' => $cost_type,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateUserRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUserRequest $request)
    {
        if (Auth::user()->role_id == 2)
        {
            $company = Company::where('id', Auth::user()->company_id)->pluck('id');
            $role = Role::find($request->role_id);
            if (!in_array($request->company_id, $company->toArray()) || $role->name == 'admin')
            {
                return redirect()->route('forbidden');
            }
            else
            {
                $user = new User;
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->email = $request->email;
                $password = $request->password;
                $user->password = bcrypt($password);
                $user->image = $request->image;

                $role = Role::find($request->role_id);
                $user->role()->associate($role);

                $company = Company::find(Auth::user()->company_id);
                $user->company()->associate($company);

                $user->save();

                return redirect()->route('user.index');
            }
        }
        else if (Auth::user()->role_id == 3)
        {
            $user = new User;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $password = $request->password;
            $user->password = bcrypt($password);
            $user->image = $request->image;

            $role = Role::find($request->role_id);
            $user->role()->associate($role);

            $company = Company::find($request->company_id);
            $user->company()->associate($company);

            $user->save();

            return redirect()->route('user.index');
        }
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
     * @param Request $request
     * @return View
     * @internal param int $id
     */
    public function edit(Request $request)
    {
        if (Auth::user()->role_id == 2)
        {
            $users = User::where('company_id', Auth::user()->company_id)->pluck('id');

            if (!in_array($request->id, $users->toArray()))
            {
                return redirect()->route('forbidden');
            }
            else
            {
                return view('user.edit', [
                    'user' => User::find($request->id),
                    'roles' => Role::where('name', '<>', 'admin')->get(),
                    'companies' => Company::where('id', Auth::user()->company_id)->get()
                ]);
            }
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('user.edit', [
                'user' => User::find($request->id),
                'roles' => Role::all(),
                'companies' => Company::all(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateUserRequest|Request $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(StoreUpdateUserRequest $request)
    {
        if (Auth::user()->role_id == 2)
        {
            $users = User::where('company_id', Auth::user()->company_id)->pluck('id');

            if (!in_array($request->id, $users->toArray()))
            {
                return redirect()->route('forbidden');
            }
            else
            {
                $user = User::find($request->id);
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->email = $request->email;
                $user->image = $request->image;

                $role = Role::find($request->role_id);
                $user->role()->associate($role);

                $user->save();

                return redirect()->route('user.index');
            }
        }
        else if (Auth::user()->role_id == 3)
        {
            $user = User::find($request->id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->image = $request->image;

            $role = Role::find($request->role_id);
            $user->role()->associate($role);

            $company = Company::find($request->company_id);
            $user->company()->associate($company);

            $user->save();

            return redirect()->route('user.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Http\Controllers\Models\Web\EditDeleteUserRequest|EditDeleteUserRequest $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(EditDeleteUserRequest $request)
    {
        if (Auth::user()->role_id == 2)
        {
            $users = User::where('company_id', Auth::user()->company_id)->pluck('id');

            if (!in_array($request->id, $users->toArray()))
            {
                return redirect()->route('forbidden');
            }
            else
            {
                $user = User::where('id', $request->id);
                $user->delete();

                return redirect()->route('user.index');
            }
        }
        else if (Auth::user()->role_id == 3)
        {
            $user = User::where('id', $request->id);
            $user->delete();

            return redirect()->route('user.index');
        }
    }
}
