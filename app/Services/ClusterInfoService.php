<?php

namespace App\Services;

use App\Repositories\ClusterInfoRepository;
use App\Validators\ClusterInfoValidator;
use Prettus\Validator\Contracts\ValidatorInterface;


class ClusterInfoService
{
	private $repository;
	private $validator;

	public function __construct(ClusterInfoRepository $repository, ClusterInfoValidator $validator)
	{
		$this->repository 	= $repository;
		$this->validator 	= $validator;
	}

    public function index()
    {
        return $this->repository->paginate(5);
    }

    public function show($id){
    	return $this->repository->find($id);
    }

	public function store(array $data)
	{
		try
		{
            
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$clusterInfo = $this->repository->create($data);
			
			return [
				'success' 	=> true,
				'messages' 	=> "ClusterInfo created successfully.",
				'data' 	  	=> $clusterInfo,
			];
		}
		catch(Exception $e)
		{
			switch(get_class($e))
			{
				case QueryException::class 		:  return ['success' => false, 'messages' => $e->getMessage()];
				case ValidatorException::class 	:  return ['success' => false, 'messages' => $e->getMessageBag()];
				case Exception::class 			:  return ['success' => false, 'messages' => $e->getMessage()];
				default 						:  return ['success' => false, 'messages' => get_class($e)];
			}
		}
	}


	public function edit($id){
		return $this->repository->find($id);
	}


	public function update(array $data, $id)
	{
		try
		{
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			$clusterInfo = $this->repository->update($data, $id);

			return [
				'success' 	=> true,
				'messages' 	=> "ClusterInfo updated successfully.",
				'data' 	  	=> $clusterInfo,
			];
		}
		catch(Exception $e)
		{
			switch(get_class($e))
			{
				case QueryException::class 		:  return ['success' => false, 'messages' => $e->getMessage()];
				case ValidatorException::class 	:  return ['success' => false, 'messages' => $e->getMessageBag()];
				case Exception::class 			:  return ['success' => false, 'messages' => $e->getMessage()];
				default 						:  return ['success' => false, 'messages' => get_class($e)];
			}
		}
	}

	public function destroy($id)
    {
        
        try
		{
			
			$clusterInfo = $this->repository->find($id);
			$clusterInfo->delete();
           
			return [
				'success' 	=> true,
				'messages' 	=> "ClusterInfo deleted successfully.",
				'data' 	  	=> $clusterInfo,
			];
		}
		catch(Exception $e)
		{
			switch(get_class($e))
			{
				case QueryException::class 		:  return ['success' => false, 'messages' => $e->getMessage()];
				case ValidatorException::class 	:  return ['success' => false, 'messages' => $e->getMessageBag()];
				case Exception::class 			:  return ['success' => false, 'messages' => $e->getMessage()];
				default 						:  return ['success' => false, 'messages' => get_class($e)];
			}
		}
    }

}
