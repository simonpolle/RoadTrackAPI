<?php

namespace App\Http\Controllers\Models\Web;


use App\Http\Controllers\Controller;
use App\Http\Requests\Cost\EditDeleteCostRequest;
use App\Http\Requests\Cost\StoreUpdateCostRequest;
use App\Models\Company;
use App\Models\Cost;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class CostController extends Controller
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
            $costs = Cost::where('company_id', $company->id)->paginate(10);

            return view('cost.index', [
                'costs' => $costs
            ]);
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('cost.index', [
                'costs' => Cost::paginate(10)
            ]);
        }
    }

    public function search()
    {
        if (Auth::user()->role_id == 2)
        {
            $company = Company::where('id', Auth::user()->company_id)->first();
            $costs = Cost::where('company_id', $company->id)->get();

            return view('cost.search', [
                'costs' => $costs
            ]);
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('cost.search', [
                'costs' => Cost::all()
            ]);
        }
    }

    public function indexNameAscending()
    {
        if (Auth::user()->role_id == 2)
        {
            $costs = Cost::where('company_id', Auth::user()->company_id)->orderBy('name', 'asc')->paginate(10);

            return view('cost.index', [
                'costs' => $costs
            ]);
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('cost.index', [
                'costs' => Cost::orderBy('name', 'asc')->paginate(10)
            ]);
        }
    }

    public function indexNameDescending()
    {
        if (Auth::user()->role_id == 2)
        {
            $costs = Cost::where('company_id', Auth::user()->company_id)->orderBy('name', 'desc')->paginate(10);

            return view('cost.index', [
                'costs' => $costs
            ]);
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('cost.index', [
                'costs' => Cost::orderBy('name', 'desc')->paginate(10)
            ]);
        }
    }

    public function pdf(Request $request)
    {
        if (Auth::user()->role_id == 2)
        {
            $company = Company::where('id', Auth::user()->company_id)->first();
            $costs = Cost::where('company_id', $company->id)->get();
            view()->share('costs', $costs);
        }
        else if (Auth::user()->role_id == 3)
        {
            $costs = Cost::all();
            view()->share('costs', $costs);
        }

        if ($request->has('download'))
        {
            $pdf = PDF::loadView('cost.pdf');
            return $pdf->download('costs.pdf');
        }

        return view('cost.index');
    }

    public function excel()
    {
        if (Auth::user()->role_id == 2)
        {
            $company = Company::where('id', Auth::user()->company_id)->first();
            $costs = Cost::where('company_id', $company->id)->get();
        }
        else if (Auth::user()->role_id == 3)
        {
            $costs = Cost::all();
        }
        Excel::create('costs', function ($excel) use ($costs)
        {
            $excel->sheet('Sheet 1', function ($sheet) use ($costs)
            {
                $sheet->fromArray($costs);
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
            return view('cost.create', [
                'companies' => Company::where('id', Auth::user()->company_id)->get(),
            ]);
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('cost.create', [
                'companies' => Company::all(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateCostRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCostRequest $request)
    {
        if (Auth::user()->role_id == 2)
        {
            $company = Company::where('id', Auth::user()->company_id)->pluck('id');

            if (!in_array($request->company_id, $company->toArray()))
            {
                return redirect()->route('forbidden');
            }
            else
            {
                $cost = new Cost;
                $cost->name = $request->name;
                $cost->cost = $request->cost;

                $company = Company::find(Auth::user()->company_id);
                $cost->company()->associate($company);

                $cost->save();

                return redirect()->route('cost.index');
            }
        }
        else if (Auth::user()->role_id == 3)
        {
            $cost = new Cost;
            $cost->name = $request->name;
            $cost->cost = $request->cost;

            $company = Company::find($request->company_id);
            $cost->company()->associate($company);

            $cost->save();

            return redirect()->route('cost.index');
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
     * @param EditDeleteCostRequest|Request $request
     * @return View
     * @internal param int $id
     */
    public function edit(EditDeleteCostRequest $request)
    {
        if (Auth::user()->role_id == 2)
        {
            $costs = Cost::where('company_id', Auth::user()->company_id)->pluck('id');

            if (!in_array($request->id, $costs->toArray()))
            {
                return redirect()->route('forbidden');
            }
            else
            {
                return view('cost.edit', [
                    'cost' => Cost::find($request->id),
                    'companies' => Company::where('id', Auth::user()->company_id)->get(),
                ]);
            }
        }
        else if (Auth::user()->role_id == 3)
        {
            return view('cost.edit', [
                'cost' => Cost::find($request->id),
                'companies' => Company::all(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateCostRequest|Request $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(StoreUpdateCostRequest $request)
    {
        if (Auth::user()->role_id == 2)
        {
            $costs = Cost::where('company_id', Auth::user()->company_id)->pluck('id');

            if (!in_array($request->id, $costs->toArray()))
            {
                return redirect()->route('forbidden');
            }
            else
            {
                $cost = Cost::find($request->id);
                $cost->name = $request->name;
                $cost->cost = $request->cost;

                $company = Company::find(Auth::user()->company_id);
                $cost->company()->associate($company);

                $cost->save();

                return redirect()->route('cost.index');
            }
        }
        else if (Auth::user()->role_id == 3)
        {
            $cost = Cost::find($request->id);
            $cost->name = $request->name;
            $cost->cost = $request->cost;

            $company = Company::find($request->company_id);
            $cost->company()->associate($company);

            $cost->save();

            return redirect()->route('cost.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param EditDeleteCostRequest $request
     * @return \Illuminate\Http\Response
     * @internal param $ |EditDeleteCostRequest $request
     * @internal param int $id
     */
    public function destroy(EditDeleteCostRequest $request)
    {
        if (Auth::user()->role_id == 2)
        {
            $costs = Cost::where('company_id', Auth::user()->company_id)->pluck('id');

            if (!in_array($request->id, $costs->toArray()))
            {
                return redirect()->route('forbidden');
            }
            else
            {
                $cost = Cost::where('id', $request->id);
                $cost->delete();

                return redirect()->route('cost.index');
            }
        }
        else if (Auth::user()->role_id == 3)
        {
            $cost = Cost::where('id', $request->id);
            $cost->delete();

            return redirect()->route('cost.index');
        }
    }
}
