
@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>ClusterInfo Management</h2>
        </div>
        <div class="pull-right">
        @can('role-create')
            <a class="btn btn-success" href="{{ route('clusterInfos.create') }}"> Create New ClusterInfo</a>
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
     <th>Cluster IP</th>
     <th>Cluster Username</th>
     <th>Cluster's Sites</th>
     <th width="280px">Action</th>
  </tr>
    @foreach ($clusterInfos as $key=>$clusterInfo)
    <tr>
        <td>{{ ++$key }}</td>
        <td>{{ $clusterInfo->cluster_ip }}</td>
        <td>{{ $clusterInfo->cluster_username }}</td>
       
        <td><ul>
             @foreach ($clusterInfo->sites as $site)
               <li> {{ $site->sitename_bn }}</li>
              @endforeach
            </ul>  
        </td>
        <td>
            <a class="btn btn-info" href="{{ route('clusterInfos.show',$clusterInfo->id) }}">Show</a>
            @can('role-edit')
                <a class="btn btn-primary" href="{{ route('clusterInfos.edit',$clusterInfo->id) }}">Edit</a>
            @endcan
            @can('role-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['clusterInfos.destroy', $clusterInfo->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
    </tr>
    @endforeach
</table>


{!! $clusterInfos->render() !!}


@endsection