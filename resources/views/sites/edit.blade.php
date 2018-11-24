@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Site</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('sites.index') }}"> Back</a>
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


{!! Form::model($site, ['method' => 'PATCH','route' => ['sites.update', $site->id]]) !!}
<div class="row">
     <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Site Bangla Name:</strong>
            {!! Form::text('sitename_bn', null, array('placeholder' => 'Site bangla name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Site English Name:</strong>
            {!! Form::text('sitename_en', null, array('placeholder' => 'Site english name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Site Email:</strong>
            {!! Form::text('site_email', null, array('placeholder' => 'Site email','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Site Bangla Slogan:</strong>
            {!! Form::text('site_slogan_bn', null, array('placeholder' => 'Site bangla slogan','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Site English Slogan:</strong>
            {!! Form::text('site_slogan_en', null, array('placeholder' => 'Site english Slogan','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Users:</strong>
            <br/>
            @foreach($users as $value)
                <label>{{ Form::checkbox('user[]', $value->id, in_array($value->id, $siteUser) ? true : false, array('class' => 'name')) }}
                {{ $value->name }}</label>
            <br/>
            @endforeach
        </div>
    </div>


    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Cluster ID:</strong>
           
            {!! Form::select('cluster_id', ['' => 'Select Cluster'] +$clusterInfo_list,[$site->id], array('class' => 'form-control')) !!}

             
           
        </div>
    </div>


   
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}


@endsection