<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\LayerCreateRequest;
use App\Http\Requests\LayerUpdateRequest;
use App\Repositories\LayerRepository;
use App\Validators\LayerValidator;

/**
 * Class LayersController.
 *
 * @package namespace App\Http\Controllers;
 */
class LayersController extends Controller
{
    /**
     * @var LayerRepository
     */
    protected $repository;

    /**
     * @var LayerValidator
     */
    protected $validator;

    /**
     * LayersController constructor.
     *
     * @param LayerRepository $repository
     * @param LayerValidator $validator
     */
    public function __construct(LayerRepository $repository, LayerValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $layers = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $layers,
            ]);
        }

        return view('layers.index', compact('layers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LayerCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(LayerCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $layer = $this->repository->create($request->all());

            $response = [
                'message' => 'Layer created.',
                'data'    => $layer->toArray(),
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
        }
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
        $layer = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $layer,
            ]);
        }

        return view('layers.show', compact('layer'));
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
        $layer = $this->repository->find($id);

        return view('layers.edit', compact('layer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LayerUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(LayerUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $layer = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Layer updated.',
                'data'    => $layer->toArray(),
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
        }
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
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Layer deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Layer deleted.');
    }
}
