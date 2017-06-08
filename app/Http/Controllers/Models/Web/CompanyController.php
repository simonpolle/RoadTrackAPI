<?php

namespace App\Http\Controllers\Models\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\EditDeleteCompanyRequest;
use App\Http\Requests\Company\StoreUpdateCompanyRequest;
use App\Models\Company;
use App\Models\Country;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('company.index', [
            'companies' => Company::paginate(10)
        ]);
    }

    public function search()
    {
        return view('company.search', [
            'companies' => Company::all()
        ]);
    }

    /**
     * Sorts the resource ascending by name
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexNameAscending()
    {
        return view('company.index', [
            'companies' => Company::orderBy('name', 'asc')->paginate(10)
        ]);
    }

    /**
     * Sorts the resource descending by name
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexNameDescending()
    {
        return view('company.index', [
            'companies' => Company::orderBy('name', 'desc')->paginate(10)
        ]);
    }

    /**
     * Sorts the resource ascending by street
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexAddressAscending()
    {
        return view('company.index', [
            'companies' => Company::orderBy('street', 'asc')->paginate(10)
        ]);
    }

    /**
     * Sorts the resource descending by street
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexAddressDescending()
    {
        return view('company.index', [
            'companies' => Company::orderBy('street', 'desc')->paginate(10)
        ]);
    }

    /**
     * Generates and downloads a pdf file from the resource
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pdf(Request $request)
    {
        $companies = Company::all();
        view()->share('companies', $companies);

        if ($request->has('download')) {
            $pdf = PDF::loadView('company.pdf');
            return $pdf->download('company.pdf');
        }

        return view('company.index');
    }

    /**
     * Generates and downloads an excel file from the resource
     */
    public function excel()
    {
        $companies = Company::all();
        Excel::create('companies', function ($excel) use ($companies) {
            $excel->sheet('Sheet 1', function ($sheet) use ($companies) {
                $sheet->fromArray($companies);
            });
        })->download('xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create', [
            'countries' => Country::all(),
            'users' => User::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateCompanyRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCompanyRequest $request)
    {
        $company = new Company;
        $company->name = $request->name;
        $company->street = $request->street;
        $company->street_number = $request->street_number;
        $company->postal_code = $request->postal_code;

        $country = Country::find($request->country_id);
        $company->country()->associate($country);

        $company->vat_number = $request->vat_number;

        $user = User::find($request->user_id);
        $company->user()->associate($user);

        $company->save();

        return redirect()->route('company.index');
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
     * @param EditDeleteCompanyRequest $request
     * @return \Illuminate\Http\Response
     * @internal param $EditDeleteCompanyRequest
     * @internal param int $id
     */
    public function edit(EditDeleteCompanyRequest $request)
    {
        return view('company.edit', [
            'company' => Company::find($request->id),
            'users' => User::all(),
            'countries' => Country::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(StoreUpdateCompanyRequest $request)
    {
        $company = Company::find($request->id);
        $company->name = $request->name;
        $company->street = $request->street;
        $company->street_number = $request->street_number;
        $company->postal_code = $request->postal_code;

        $country = Country::find($request->country_id);
        $company->country()->associate($country);

        $company->vat_number = $request->vat_number;
        $user = User::find($request->user_id);
        $company->user()->associate($user);

        $company->save();

        return redirect()->route('company.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param EditDeleteCompanyRequest $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(EditDeleteCompanyRequest $request)
    {
        $company = Company::where('id', $request->id);
        $company->delete();

        return redirect()->route('company.index');
    }
}
