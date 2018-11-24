
@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Domain Management</h2>
        </div>
        <div class="pull-right">
        @can('role-create')
            <a class="btn btn-success" href="{{ route('domains.create') }}"> Create New Domain</a>
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
     <th>Domain URL</th>
     <th>Domain Alias Bangla</th>
     <th>Domain Alias English</th>
     <th>Site Name</th>
     <th width="280px">Action</th>
  </tr>
    @foreach ($domains as $key=>$domain)
    <tr>
        <td>{{ ++$key }}</td>
        <td>{{ $domain->domain_url }}</td>
        <td>{{ $domain->domain_alias_bn }}</td>
        <td>{{ $domain->domain_alias_en }}</td>
        <td>
            {{ $domain->site->sitename_bn }}
        </td>
        <td>
            <a class="btn btn-info" href="{{ route('domains.show',$domain->id) }}">Show</a>
            @can('role-edit')
                <a class="btn btn-primary" href="{{ route('domains.edit',$domain->id) }}">Edit</a>
            @endcan
            @can('role-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['domains.destroy', $domain->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
    </tr>
    @endforeach
</table>


{!! $domains->render() !!}


@endsection