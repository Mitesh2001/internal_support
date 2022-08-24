<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['contacts'] = Contact::all();
        return view('contact.index',$data);
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

        // $request->validate([
        //     'full_name' => 'required',
        // ]);

        $profile_pic_name = "";

        if($request->hasFile('profile')) {

            $full_name  = strtolower(str_replace(' ', '_',$request->full_name));

            $pic_name = $full_name ."_". time() .".". $request->profile->extension();
            $path_profile_pic = 'storage/assets/contacts/profile_pics/';
            $returned = $request->profile->move(public_path($path_profile_pic), $pic_name);

            $profile_pic_name = $path_profile_pic . $pic_name;
        }


        $new_contact = Contact::create([
            'photo' => $profile_pic_name,
            'full_name' => $request->full_name,
            'title' => $request->title,
            'contact_details' => $request->contact_details,
            'email' => $request->email,
            'work_phone' => $request->work_phone,
            'mobile_number' => $request->mobile_number,
            'twitter_id' => $request->twitter_id,
            'external_id' => $request->external_id,
            'company_id' => $request->company_id,
            'address' => $request->address,
            'language_id' => $request->language_id,
            'about' => $request->about
        ]);

        if ($new_contact) {

            $message = "New Contact created successfully !";

            return redirect(route('contact.index'))->with('success', $message);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        $data['contact'] = $contact;
        return view('contact.contact',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }

    public function getRequesters(Request $request)
    {
        $keyword = $request->get('q');
        $contacts = Contact::select('id','email', 'full_name')
                ->where('email', 'like', "%{$keyword}%")
                ->orWhere('full_name', 'like', "%{$keyword}%")
                ->get();

        $response = [];

        foreach ($contacts as $key => $contact) {
            $response[] = [
                'id' => $contact->id,
                'text' => '"'.$contact->full_name.'" <'.$contact->email.'>'
            ];
        }

        return response()->json($response);
    }

    public function checkEmail(Request $request)
    {
        $contact = Contact::where('email', $request->email)->first();
        echo $contact !== null ? "false" : "true";
    }
}
