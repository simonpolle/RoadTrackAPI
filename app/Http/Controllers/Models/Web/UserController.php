<?php

namespace App\Http\Controllers\Models\Web;


use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Role;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
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
        return view('user.create', [
            'roles' => Role::where('name', '<>', 'admin')->get(),
            'companies' => Company::where('id', Auth::user()->company_id)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
                $user->role_id = $request->role_id;
                $user->company_id = $request->company_id;
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
            $user->role_id = $request->role_id;
            $user->company_id = $request->company_id;
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
