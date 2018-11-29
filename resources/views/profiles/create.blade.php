@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New Profile</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('profiles.index') }}"> Back</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif


{!! Form::open(array('route' => 'profiles.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>First Name:</strong>
            {!! Form::text('first_name', null, array('placeholder' => 'First Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Last Name:</strong>
            {!! Form::text('last_name', null, array('placeholder' => 'Last Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Details Name:</strong>
            {!! Form::text('details', null, array('placeholder' => 'Details Name','class' => 'form-control')) !!}
        </div>
    </div>
   

    {{-- <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Site:</strong>
           
            {!! Form::select('site_id', ['' => 'Select Site'] +$site_list,[], array('class' => 'form-control')) !!}

             
           
        </div>
    </div> --}}

    
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
        {!! Form::submit('Submit',array('class' => 'btn btn-primary'))!!}
    </div>
</div>
{!! Form::close() !!}


@endsection