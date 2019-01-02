@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Domain</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('domains.index') }}"> Back</a>
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


{!! Form::model($domain, ['method' => 'PATCH','route' => ['domains.update', $domain->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Domain URL:</strong>
            {!! Form::text('domain_url', null, array('placeholder' => 'Domain URL','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Domain Alias Bangla:</strong>
            {!! Form::text('domain_alias_bn', null, array('placeholder' => 'Domain Alias Bangla','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Domain Alias English:</strong>
            {!! Form::text('domain_alias_en', null, array('placeholder' => 'Domain Alias English','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Site:</strong>
           
            {!! Form::select('site_id', ['' => 'Select Site'] +$site_list,[$domain->id], array('class' => 'form-control')) !!}
        </div>
    </div>


   
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}


@endsection