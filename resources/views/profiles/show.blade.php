@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Profile</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('profiles.index') }}"> Back</a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>First Name:</strong>
            {{ $profiles->first_name }}</br>
            <strong>Last Name:</strong>
            {{ $profiles->last_name }}</br>
            <strong>Description:</strong>
            {{ $profiles->details }}</br>
            <strong>Image:</strong>
            <img src="/profile_image/{{ $profiles->image }}" style="width: 100px;height: 100px;"></br>
            
          
        </div>
    </div>

</div>
@endsection
