@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show ClusterInfo</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('clusterInfos.index') }}"> Back</a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Cluster IP:</strong>
            {{ $clusterInfo->cluster_ip }}</br>
            <strong>Cluster Username:</strong>
            {{ $clusterInfo->cluster_username }}</br>
            <strong>Cluster Password:</strong>
            {{ $clusterInfo->cluster_password }}</br>
            <strong>Sites of Cluster:</strong>
           </br>
           <ul>
             @foreach ($clusterInfo->sites as $site)
               <li> {{ $site->sitename_bn }}</li>
              @endforeach
            </ul> 
          
        </div>
    </div>

</div>
@endsection