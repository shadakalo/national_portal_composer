
@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Sites Management</h2>
        </div>
        <div class="pull-right">
        @can('role-create')
            <a class="btn btn-success" href="{{ route('sites.create') }}"> Create New Site</a>
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
     <th>Site Bangla Name</th>
     <th>Site English Name</th>
     <th>Site Email</th>
     <th width="280px">Action</th>
  </tr>
    @foreach ($sites as $key=>$site)
    <tr>
        <td>{{ ++$key }}</td>
        <td>{{ $site->sitename_bn }}</td>
        <td>{{ $site->sitename_en }}</td>
        <td>{{ $site->site_email }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('sites.show',$site->id) }}">Show</a>
            @can('role-edit')
                <a class="btn btn-primary" href="{{ route('sites.edit',$site->id) }}">Edit</a>
            @endcan
            @can('role-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['sites.destroy', $site->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
    </tr>
    @endforeach
</table>


{!! $sites->render() !!}


@endsection