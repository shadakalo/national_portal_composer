<?php

namespace App\Services;

use App\Repositories\DomainRepository;
use App\Validators\DomainValidator;
use Prettus\Validator\Contracts\ValidatorInterface;


class DomainService
{
	private $repository;
	private $validator;

	public function __construct(DomainRepository $repository, DomainValidator $validator)
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
		    dd($data);
            
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$domain = $this->repository->create($data);
			
			return [
				'success' 	=> true,
				'messages' 	=> "Domain created successfully.",
				'data' 	  	=> $domain,
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
			$domain = $this->repository->update($data, $id);

			return [
				'success' 	=> true,
				'messages' 	=> "Domain updated successfully.",
				'data' 	  	=> $domain,
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
			
			$domain = $this->repository->find($id);
			$domain->delete();
           
			return [
				'success' 	=> true,
				'messages' 	=> "Domain deleted successfully.",
				'data' 	  	=> $domain,
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
