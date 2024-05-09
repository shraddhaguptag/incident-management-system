<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        if (request('search')) {
        $data = Incident::where('incident_number', 'like', '%' . request('search') . '%')
        ->where('user_id',$user_id)->orderBy('id','DESC')->paginate(10);
                 

        //Stuck in here
        }else{
            $data = Incident::where('user_id',$user_id)->orderBy('id','DESC')->paginate(10);
        }

      //  dd($data);
        return view('incidents.index',compact('data'));
    }

    public function create()
    {
        $user = auth()->user();
        return view('incidents.create', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $rules = array(
            'name' => 'required',
            'details' => 'required|string',
          //  'incident_number' => 'required|string|max:255|unique:incidents',
            'status' => 'required',
            'user_id' => 'required',
            'priority' => 'required|not_in:0',
        );
         $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('incident/create')
                ->withErrors($validator);
        }
        $incident = new Incident();
        $incident->name = $request->input('name');
        $incident->user_id = $request->input('user_id');
        $incident->details = $request->input('details');
        $incident->incident_number = $this->generateIncidentId();
        $incident->status = $request->input('status');
        $incident->priority = $request->input('priority');
        $incident->limitations = "limitationssssss";
        $incident->save();
        return redirect()->route('incidents')->with('success','Incident created successfully...');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $incident = Incident::find($id);
        return view('incidents.show', compact('incident'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $incident = Incident::find($id);
        return view('incidents.edit', compact('incident'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $incidents = Incident::find($id);
        $rules = array(
            'name' => 'required',
            'details' => 'required|string',
            'status' => 'required',
            'user_id' => 'required',
            'priority' => 'required|not_in:0',
        );
         $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to("edit/incident/".$id)
                ->withErrors($validator);
        }

        $incident = Incident::where("id", $id)->update([
        "status" => $request->status,
        "priority" => $request->priority,
        "details" => $request->details,
        ]);
        return redirect()->route('incidents')->with('success','Incident updated successfully...');
    }

    public function destroy ($id){
        Incident::where('id', $id)->delete();
        return redirect()->route('incidents')->with('success','Incident deleted successfully...');
    }

    public function generateIncidentId()
    {
        // Generate random 5-digit number
        $randomNumber = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

        // Get current year
        $currentYear = date('Y');

        // Concatenate components to form product ID
        $incidentId = 'RMG' . $randomNumber . $currentYear;

        return $incidentId;
    }

    
}
