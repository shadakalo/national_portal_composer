<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\DomainCreateRequest;
use App\Http\Requests\DomainUpdateRequest;

use App\Repositories\SiteRepository;

use App\Services\DomainService;
/**
 * Class DomainsController.
 *
 * @package namespace App\Http\Controllers;
 */
class DomainsController extends Controller
{
    
    protected $siteRepository;

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
    public function __construct(DomainService $service,SiteRepository $siteRepository)
    {
        $this->siteRepository  = $siteRepository;
        $this->service         = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $domains = $this->service->index();
        return view('domains.index', compact('domains'));
    }



    public function create(){
        $site_list = $this->siteRepository->selectBoxList();

        
        return view('domains.create',compact('site_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DomainCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(DomainCreateRequest $request)
    {
        $request = $this->service->store($request->all());

        session()->flash('success', [
            'success'   => $request['success'],
            'messages'  => $request['messages']
        ]);

        return redirect()->route('domains.index');
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
       
        $domain = $this->service->show($id);
        return view('domains.show', compact('domain'));
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
     
        $domain = $this->service->edit($id);
        $site_list = $this->siteRepository->selectBoxList();
        return view('domains.edit', compact('domain','site_list'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  DomainUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(DomainUpdateRequest $request, $id)
    {
        $request = $this->service->update($request->all(), $id);
      
        session()->flash('success', [
            'success'   => $request['success'],
            'messages'  => $request['messages']
        ]);

        return redirect()->route('domains.index');
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

        return redirect()->route('domains.index');
    }
}
