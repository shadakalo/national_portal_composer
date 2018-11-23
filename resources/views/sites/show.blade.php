@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Site</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('sites.index') }}"> Back</a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Site Bangla Name:</strong>
            {{ $site->sitename_bn }}</br>
            <strong>Site English Name:</strong>
            {{ $site->sitename_en }}</br>
            <strong>Site Email:</strong>
            {{ $site->site_email }}</br>
            <strong>Site Bangla Slogan:</strong>
            {{ $site->site_slogan_bn }} </br>
            <strong>Site English Slogan:</strong>
            {{ $site->site_slogan_en }}
        </div>
    </div>

</div>
@endsection