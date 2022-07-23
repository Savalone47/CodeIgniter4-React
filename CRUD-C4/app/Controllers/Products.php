<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductModel;

class Products extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;
    public function index()
    {
        $model = new ProductModel();
        $data = $model->findAll();
        return $this->respond($data, 201);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $model = new ProductModel();
        $data = $model->find(['id' => $id]);
        if(!$data) return $this->failNotFound('No data found');
        return $this->respond($data[0]);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        helper(['form']);
        $rules = [
            'title' => 'required',
            'price' => 'required'
        ];
        $data = [
            'title' => $this->request-getPost('title'),
            'price' => $this->request->gePost('price')
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        $model = new ProductModel();
        $model->save($data);
        $response = [
            'status' => 201,
            'error'=> null,
            'message' => [
                'success' => 'Data inserted'
            ]
        ];
        return $this->respondCreated($data, 201);
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        helper(['form']);
        $rules = [
            'title' => 'required',
            'price' => 'required'
        ];
        $data = [
            'title' => $this->request-getVar('title'),
            'price' => $this->request->getVar('price')
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        $model = new ProdcutModel();
        $findById = $model->find(['id' => $id]);

        if(!$findById) return $this->failNotFound('No data found');
        $model->update($id, $data);
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'data updated'
            ]
        ];
        return $this->respond($response);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new ProductModel();
        $findById = $model->find(['id'=> $id]);
        if(!$findById) return $this->failNotFound('No data found');

        $model->delete($id);
        $response = [
            'status'=> 200,
            'error' => null,
            'messages' => [
                'success' => 'Data deleted'
            ]
        ];
        return $this->respond($response);
    }
}
