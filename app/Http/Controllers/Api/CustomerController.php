<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerLockedCollection;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\ErrorResource;
use App\Models\Customer;
use App\Models\ErrorResponse;
use App\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }


    public function show($id)
    {
        $customer = $this->customerService->find($id);
        return CustomerResource::make($customer);
    }

    public function index()
    {
        $customers = $this->customerService->getAll();
        return CustomerCollection::make($customers);
    }

    public function store(Request $request)
    {
        $data = json_decode($request->getContent());
        try {
            $customer = $this->customerService->createCustomer($data);

        } catch (\Exception $exception) {
            return ErrorResource::make(
                new ErrorResponse('215', $exception->getMessage(), 'errors/validation'));
        }
        return CustomerResource::make($customer);
    }

    public function update(Request $request)
    {
        $data = json_decode($request->getContent());
        try {
            $customer = $this->customerService->updateCustomer($data);
        } catch (\Exception $exception) {
            return ErrorResource::make(
                new ErrorResponse('215', $exception->getMessage(), 'errors/validation'));
        }
        return CustomerResource::make($customer);
    }

    public function blockCustomer($id)
    {
        try {
            $this->customerService->blockCustomer($id);
        } catch (\Exception $exception) {
            return ErrorResource::make(
                new ErrorResponse('215', $exception->getMessage(), 'errors/validation'));
        }
        return response(['message' => 'Customer blocked successfully', 'code' => '200']);
    }

    public function blockedCustomers()
    {
        $customers = $this->customerService->getAllLocked();
        return CustomerLockedCollection::make($customers);
    }
}
