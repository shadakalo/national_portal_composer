<?php

namespace App\Services;

use App\Entities\Profile;
use App\Repositories\ProfileRepository;
use App\Validators\ProfileValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Image;

class ProfileService
{
	private $repository;
	private $validator;

	public function __construct(ProfileRepository $repository, ProfileValidator $validator)
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
            if(!empty($data['image']))
            {
                $image=$data['image'];
                $filename=time().'.'.$image->getClientOriginalExtension();
                Image::make($image)->save(public_path('/profile_image/').$filename);
                $data['image']=$filename;
            }
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$profile = $this->repository->create($data);
			
			return [
				'success' 	=> true,
				'messages' 	=> "Profile created successfully.",
				'data' 	  	=> $profile,
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

            $profile = $this->repository->find($id);
            //dd($profile);
            if(!empty($data['image']))
            {
                unlink(public_path('/profile_image/').$profile->image);
                $image=$data['image'];
                $filename=time().'.'.$image->getClientOriginalExtension();
                Image::make($image)->save(public_path('/profile_image/').$filename);
                $data['image']=$filename;
            }

			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			$profile = $this->repository->update($data, $id);

			return [
				'success' 	=> true,
				'messages' 	=> "Profile updated successfully.",
				'data' 	  	=> $profile,
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

			
			$profile = $this->repository->find($id);
            unlink(public_path('/profile_image/').$profile->image);
			$profile->delete();
           
			return [
				'success' 	=> true,
				'messages' 	=> "Profile deleted successfully.",
				'data' 	  	=> $profile,
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
