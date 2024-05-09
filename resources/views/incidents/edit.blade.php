@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('layouts.sidebar')
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Edit incident
                         <a class="btn btn-primary float-right" href="{{ route('incident.show', $incident->id) }}" style="" title="Show incident">Back</a>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('incident.update',$incident->id) }}">
                            @csrf
                            <input type="hidden" name="status" value="In progress">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="container">
                                 @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <div class="form-row">
                                         <div class="form-group col-md-4">
                                            <label for="incident_number">Incident ID</label>
                                            <input type="text" class="form-control" readonly name="incident_number" value="{{ $incident->incident_number}}">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="name">Reporter name</label>
                                            <input type="text" class="form-control" readonly id="name" name="name" value="{{ Auth::user()->first_name }}">
                                        </div>
                                        
                                        <div class="form-group col-md-4">
                                            <label for="priority">Priority</label>
                                            <select id="priority" name="priority" class="form-control">
                                                <option {{ $incident->priority == 'High' ? 'selected':'' }}>High</option>
                                                 <option {{ $incident->priority == 'Medium' ? 'selected':'' }}>Medium</option>
                                                <option {{ $incident->priority == 'Low' ? 'selected':'' }}>Low</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <label for="exampleFormControlTextarea1">Details</label>
                                        <textarea class="form-control" id="details" name="details" rows="3">{{$incident->details}}</textarea>
                                    </div>
                                      <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="dateTime">Reported Date Time</label>
                                            <input type="text" class="form-control" readonly  value="{{$incident->created_at->toDayDateTimeString()}}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="status">Status</label>
                                            <select id="status" name="status" class="form-control" >
                                                 <option {{ $incident->status == 'Open' ? 'selected':'' }}>Open</option>
                                                 <option {{ $incident->status == 'In progress' ? 'selected':'' }}>In progress</option>
                                                <option {{ $incident->status == 'Closed' ? 'selected':'' }}>Closed</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-row">
                                        <button type="submit" class="btn btn-success" title="Save">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection