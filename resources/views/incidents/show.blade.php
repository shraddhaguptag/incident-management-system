@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('layouts.sidebar')
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Incident details
                        <a class="btn btn-primary float-right" href="{{ route('incident.edit', $incident->id) }}" style="" title="Edit incident">Edit</a>
                    </div>


                    <div class="card-body">
                      
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="container">
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" readonly id="name" name="name" value="{{ Auth::user()->first_name }}">
                                        </div>
                                        
                                        <div class="form-group col-md-4">
                                            <label for="priority">Priority</label>
                                            <select id="priority" name="priority" class="form-control" readonly>
                                                <option selected >{{ $incident->priority}}</option>
                                              
                                            </select>
                                        </div>
                                         <div class="form-group col-md-4">
                                            <label for="incident_number">Incident ID</label>
                                            <input type="text" class="form-control" readonly name="incident_number" value="{{ $incident->incident_number}}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <label for="exampleFormControlTextarea1">Details</label>
                                        <textarea class="form-control" id="details" name="details" rows="3" readonly value="{{ $incident->details }}">{{ $incident->details }}</textarea>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="dateTime">Reported Date Time</label>
                                            <input type="text" class="form-control" readonly  value="{{$incident->created_at->toDayDateTimeString()}}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="status">Status</label>
                                            <input type="text" class="form-control" readonly name="status" value="{{ $incident->status}}">
                                        </div>
                                    </div>
                                </div>
                               
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection