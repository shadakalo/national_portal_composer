<?php

namespace App\Http\Controllers;


use App\Entities\Profile;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ProfileCreateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Repositories\ProfileRepository;
use Image;
use App\Services\ProfileService;

/**
 * Class ProfilesController.
 *
 * @package namespace App\Http\Controllers;
 */
class ProfilesController extends Controller
{
    /**
     * @var ProfileRepository
     */
    protected $profileRepository;

    /**
     * @var ProfileValidator
     */
    protected $service;

    /**
     * ProfilesController constructor.
     *
     * @param ProfileRepository $repository
     * @param ProfileValidator $validator
     */
    public function __construct(ProfileRepository $profileRepository, ProfileService $service)
    {
        $this->profileRepository = $profileRepository;
        $this->service  = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $profiles = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $profiles,
            ]);
        }

        return view('profiles.index', compact('profiles'));*/
        //$user=Auth::user()->id;
        //dd($user);
        $profiles = $this->service->index();
        return view('profiles.index', compact('profiles'));
    
    }


    public function create(){
        //$profiles = $this->profileRepository->selectBoxList();
        $id=Auth::user()->id;
        $user=Profile::find($id);
        if($user !=null)
        {
            echo "user Exist";

        }
        else
        {
            return view('profiles.create',compact('id'));
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProfileCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ProfileCreateRequest $request)
    {
        /*try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $profile = $this->repository->create($request->all());

            $response = [
                'message' => 'Profile created.',
                'data'    => $profile->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }*/

        $request = $this->service->store($request->all());



        session()->flash('success', [
            'success'   => $request['success'],
            'messages'  => $request['messages']
        ]);

        return redirect()->route('profiles.index');
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
        /*$profile = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $profile,
            ]);
        }

        return view('profiles.show', compact('profile'));*/
        $profiles = $this->service->show($id);
        return view('profiles.show', compact('profiles'));

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
        $profile = $this->service->edit($id);

        return view('profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProfileUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ProfileUpdateRequest $request, $id)
    {
        /*try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $profile = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Profile updated.',
                'data'    => $profile->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }*/
        $request = $this->service->update($request->all(), $id);
      
        session()->flash('success', [
            'success'   => $request['success'],
            'messages'  => $request['messages']
        ]);

        return redirect()->route('profiles.index');
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
        /*$deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Profile deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Profile deleted.');*/
        $request = $this->service->destroy($id);
        
        session()->flash('success', [
            'success'   => $request['success'],
            'messages'  => $request['messages']
        ]);

        return redirect()->route('profiles.index');
    }
}
