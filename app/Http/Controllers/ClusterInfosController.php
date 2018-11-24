<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ClusterInfoCreateRequest;
use App\Http\Requests\ClusterInfoUpdateRequest;
use App\Services\ClusterInfoService;

/**
 * Class ClusterInfosController.
 *
 * @package namespace App\Http\Controllers;
 */
class ClusterInfosController extends Controller
{
    

    /**
     * @var SiteValidator
     */
    protected $service;

    /**
     * DomainsController constructor.
     *
     * @param DomainRepository $repository
     * @param DomainValidator $validator
     */
    public function __construct(ClusterInfoService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clusterInfos = $this->service->index();
        return view('clusterInfos.index', compact('clusterInfos'));
    }



    public function create(){
        return view('clusterInfos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ClusterInfoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ClusterInfoCreateRequest $request)
    {
        $request = $this->service->store($request->all());

        session()->flash('success', [
            'success'   => $request['success'],
            'messages'  => $request['messages']
        ]);

        return redirect()->route('clusterInfos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */


    public function show($id)
    {
       
        $clusterInfo = $this->service->show($id);
        return view('clusterInfos.show', compact('clusterInfo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
 


     public function edit($id)
    {
     
        $clusterInfo = $this->service->edit($id);
        return view('clusterInfos.edit', compact('clusterInfo'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ClusterInfoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ClusterInfoUpdateRequest $request, $id)
    {
        $request = $this->service->update($request->all(), $id);
      
        session()->flash('success', [
            'success'   => $request['success'],
            'messages'  => $request['messages']
        ]);

        return redirect()->route('clusterInfos.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $request = $this->service->destroy($id);
        
        session()->flash('success', [
            'success'   => $request['success'],
            'messages'  => $request['messages']
        ]);

        return redirect()->route('clusterInfos.index');
    }
}
