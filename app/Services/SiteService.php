<?php

namespace App\Services;

use App\Repositories\SiteRepository;
use App\Validators\SiteValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class SiteService
{
	private $repository;
	private $validator;

	public function __construct(SiteRepository $repository, SiteValidator $validator)
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
			$site = $this->repository->create($data);

			return [
				'success' 	=> true,
				'messages' 	=> "Site created successfully.",
				'data' 	  	=> $site,
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
			$site = $this->repository->update($data, $id);

			return [
				'success' 	=> true,
				'messages' 	=> "Site updated successfully.",
				'data' 	  	=> $site,
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
			
			$deleted = $this->repository->delete($id);

			return [
				'success' 	=> true,
				'messages' 	=> "Site deleted successfully.",
				'data' 	  	=> $deleted,
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
