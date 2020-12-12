<?php


namespace App\Services;


use App\Repositories\CustomerRepository;
use Illuminate\Support\Facades\Validator;

class CustomerService
{
    protected $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function getAll()
    {
        return $this->customerRepository->getAll();
    }

    public function find($id)
    {
        return $this->customerRepository->find($id);
    }

    public function getAllLocked()
    {
        return $this->customerRepository->getAllLocked();
    }

    public function createCustomer($data)
    {
        $validator = Validator::make((array)$data, [
            'name' => 'required|max:55',
            'email' => 'email|required',
            'ci' => 'required|unique:customers'
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }

        return $this->customerRepository->createCustomer($data);
    }

    public function updateCustomer($data)
    {
        $validator = Validator::make((array)$data, [
            'id' => 'required',
            'name' => 'required|max:55',
            'email' => 'email|required',
            'ci' => [
                'required',
                'unique:customers,ci,' . $data->id,
            ]
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }

        $customer = $this->customerRepository->updateCustomer($data);;
        if (!$customer) {
            throw new \Exception("id does not exist");
        }
        return $customer;
    }

    public function blockCustomer($id)
    {
        $customer = $this->customerRepository->blockCustomer($id);;
        if (!$customer) {
            throw new \Exception("id does not exist");
        }
        return true;
    }

}
