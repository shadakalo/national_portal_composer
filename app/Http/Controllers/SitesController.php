<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SiteCreateRequest;
use App\Http\Requests\SiteUpdateRequest;
use App\Services\SiteService;
use DB;
use App\User;


use App\Repositories\ClusterInfoRepository;

/**
 * Class SitesController.
 *
 * @package namespace App\Http\Controllers;
 */
class SitesController extends Controller
{
   


     protected $clusterInfoRepository;

    /**
     * @var SiteValidator
     */
    protected $service;

    

    /**
     * SitesController constructor.
     *
     * @param SiteRepository $repository
     * @param SiteValidator $validator
     */


    public function __construct(SiteService $service,ClusterInfoRepository $clusterInfoRepository)
    {
         $this->clusterInfoRepository  = $clusterInfoRepository;
         $this->service  = $service;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $sites = $this->service->index();

      
        return view('sites.index', compact('sites'));

    }

    public function create(){
        $users=User::get();
        $clusterInfo_list = $this->clusterInfoRepository->selectBoxList();
        return view('sites.create',compact('users','clusterInfo_list'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  SiteCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(SiteCreateRequest $request)
    {

        $request = $this->service->store($request->all());

        session()->flash('success', [
            'success'   => $request['success'],
            'messages'  => $request['messages']
        ]);

        return redirect()->route('sites.index');
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
       
        $site = $this->service->show($id);

      
        return view('sites.show', compact('site'));
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
     
        $site = $this->service->edit($id);
        $users=User::get();
        $siteUser = DB::table("user_site")->where("user_site.site_id",$id)
            ->pluck('user_site.user_id','user_site.user_id')
            ->all();
        $clusterInfo_list = $this->clusterInfoRepository->selectBoxList();

        return view('sites.edit', compact('site','users','siteUser','clusterInfo_list'));

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  SiteUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */



    public function update(SiteUpdateRequest $request, $id)
    {
        $request = $this->service->update($request->all(), $id);
      
        session()->flash('success', [
            'success'   => $request['success'],
            'messages'  => $request['messages']
        ]);

        return redirect()->route('sites.index');
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

        return redirect()->route('sites.index');
    }

}
