<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public $health_scores = [
        0 => '--',
        1 => 'At risk',
        2 => 'Doing okay',
        3 => 'Happy'
    ];

    public $account_tier = [
        0 => '--',
        1 => 'Basic',
        2 => 'Premium',
        3 => 'Enterprise'
    ];

    public $industries = [
        0 => '--',
        1 => 'type1',
        2 => 'type2',
        3 => 'type3'
    ];

    public $industry_types =  [
        0  => "--",
        1  => "Agriculture",
        2  => "plantations",
        3  => "Basic Metal Production",
        4  => "Chemicals",
        5  => "Commerce",
        6  => "Construction",
        7  => "Education",
        8  => "Financial services ",
        9  => "professional services",
        10 => "Food",
        11 => "Drink ",
        12 => "Tobacco",
        13 => "Automotive",
        14 => "Media",
        15 => "Biotechnology",
        16 => "IT services",
        17 => "Renewable Electricity",
        18 => "Electric Utilities",
        19 => 'Other'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['companies'] = Company::all();
        return view('company.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $logo = "";

        if($request->hasFile('logo')) {

            $name  = strtolower(str_replace(' ', '_',$request->name));

            $logo_name = $name ."_". time() .".". $request->profile->extension();
            $logo_path= 'storage/assets/companies/logos/';
            $returned = $request->logo->move(public_path($logo_path), $logo_name);

            $logo = $logo_path . $logo_name;
        }

        $company = Company::create([
            'name' => $request->name,
            'description' => $request->description,
            'notes' => $request->notes,
            'domains' => $request->domains,
            'health_score' => $request->health_score,
            'account_tier' => $request->account_tier,
            'renewal_date' => $request->renewal_date,
            'industry_id' => $request->industry_type,
            'logo' => $request->logo
        ]);

        if ($company) {

            $message = "New company created successfully !";

            return redirect(route('company.index'))->with('success', $message);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $data['company'] = $company;
        $contacts = $company->contacts;
        return view('company.company',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }

    public function checkRepeatName(Request $request)
    {
        $company = Company::where('name', $request->name)->first();
        echo $company !== null ? "false" : "true";
    }

    public function getCompanies(Request $request)
    {
        $name = $request->get('q');
        $companies = Company::select('id','name')
                ->where('name', 'like', "%{$name}%")
                ->get();

        $response = [];

        foreach ($companies as $key => $company) {
            $response[] = [
                'id' => $company->id,
                'text' => $company->name
            ];
        }

        return response()->json($response);
    }
}
