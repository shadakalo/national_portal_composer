
@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Profile Management</h2>
        </div>
        <div class="pull-right">
        @can('role-create')
            <a class="btn btn-success" href="{{ route('profiles.create') }}"> Create Profile</a>
            @endcan
        </div>
    </div>
</div>




@if(session('success'))
    <div class="alert alert-success">
        <p>{{ session('success')['messages'] }}</p>
    </div>    
@endif


<table class="table table-bordered">
  <tr>
     <th>No</th>
     <th>First Name</th>
     <th>Last Name</th>
     <th>Details</th>
      <th>User Image</th>
     <th width="280px">Action</th>
  </tr>
    @foreach ($profiles as $key=>$profile)
    <tr>
        <td>{{ ++$key }}</td>
        <td>{{ $profile->first_name }}</td>
        <td>{{ $profile->last_name }}</td>
        <td>{{ $profile->details }}</td>
        <td><img src="/profile_image/{{$profile->image}}" style="height: 50px; width: 50px;"></td>
        
        <td>
            <a class="btn btn-info" href="{{ route('profiles.show',$profile->id) }}">Show</a>
            @can('role-edit')
                <a class="btn btn-primary" href="{{ route('profiles.edit',$profile->id) }}">Edit</a>
            @endcan
            @can('role-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['profiles.destroy', $profile->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
    </tr>
    @endforeach
</table>


{!! $profiles->render() !!}


@endsection
