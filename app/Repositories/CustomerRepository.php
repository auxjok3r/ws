<?php


namespace App\Repositories;


use App\Models\Customer;

class CustomerRepository
{

    function getAll()
    {
        return Customer::all();
    }

    public function find($id)
    {
        return Customer::where('id', $id)->first();
    }

    public function getAllLocked()
    {
        return Customer::where('locked', true)->get();
    }

    public function createCustomer($data)
    {
        $customer = new Customer();
        $customer->name = $data->name;
        $customer->phone = $data->phone;
        $customer->ci = $data->ci;
        $customer->email = $data->email;
        $customer->save();
        return $customer;
    }

    public function updateCustomer($data)
    {
        $customer = Customer::where('id', $data->id)->first();
        if ($customer) {
            $customer->name = $data->name;
            $customer->phone = $data->phone;
            $customer->ci = $data->ci;
            $customer->email = $data->email;
            $customer->save();
        }
        return $customer;
    }

    public function blockCustomer($id)
    {
        $customer = Customer::where('id', $id)->first();
        if ($customer) {
            $customer->locked = true;
            $customer->save();
        }
        return $customer;
    }

}
