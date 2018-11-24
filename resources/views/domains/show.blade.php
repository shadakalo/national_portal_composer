@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Domain</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('domains.index') }}"> Back</a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Domain URL:</strong>
            {{ $domain->domain_url }}</br>
            <strong>Domain Alias Bangla:</strong>
            {{ $domain->domain_alias_bn }}</br>
            <strong>Domain Alias English:</strong>
            {{ $domain->domain_alias_en }}</br>
            <strong>Domain of Site:</strong>
            {{ $domain->site->sitename_bn }} </br>
          
        </div>
    </div>

</div>
@endsection