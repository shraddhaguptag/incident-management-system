@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('layouts.sidebar')
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Add incident</div>
                    
                    <div class="card-body">
                        <form method="POST" action="{{ route('incident.store') }}">
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
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" readonly id="name" name="name" value="{{ Auth::user()->first_name }}">
                                        </div>
                                        
                                        <div class="form-group col-md-4">
                                            <label for="priority">Priority</label>
                                            <select id="priority" name="priority" class="form-control">
                                                <option value="0" selected>Choose priority...</option>
                                                <option value="High">High</option>
                                                <option value="Medium">Medium</option>
                                                <option value="Low">Low</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <label for="exampleFormControlTextarea1">Details</label>
                                        <textarea class="form-control" id="details" name="details" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-row">
                                        <button type="submit" class="btn btn-success" title="Save">Save</button>
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