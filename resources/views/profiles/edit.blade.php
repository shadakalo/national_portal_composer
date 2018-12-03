@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Profile</h2>
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


{!! Form::model($profile, ['method' => 'PATCH','route' => ['profiles.update', $profile->id],'enctype'=>'multipart/form-data']) !!}
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
            <strong>Details:</strong>
            {!! Form::text('details', null, array('placeholder' => 'Details','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>User Image:</strong>
            {!! Form::file('image',array('class' => 'form-control','onchange'=>'preview_image(event)')) !!}

        </div>
    </div>

    


   
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        {!! Form::submit('Submit',array('class' => 'btn btn-primary'))!!}
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <img id="show" src="/profile_image/{{$profile->image}}" alt="Upload image" style="height: 200px; width: 200px; margin-top: 20px;">
    </div>
</div>
{!! Form::close() !!}

<script type="text/javascript">
    function preview_image(event)
    {
        var reader = new FileReader();
        reader.onload = function()
        {
            var output = document.getElementById('show');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
