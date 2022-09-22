<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\ProductModel;


//  JANGAN LUPA ATUR ROUTE DI CONFIG FOLDER DAN CORSNYA DI APP FOLDER



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
        // untuk menampilkan semua data
        $model = new ProductModel();
        $data = $model->findAll();
        return $this->respond($data);
    }



    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        // untuk menampilkan satu data berdasarkan id
        $model = new ProductModel();
        $data = $model->find(['id' => $id]);
        if (!$data) return $this->failNotFound('No Data Found');
        return $this->respond($data[0]);
    }



    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        // inisiasi validasi input
        helper(['form']);
        $rules = [
            'title' => 'required',
            'price' => 'required'
        ];

        // mangambil data
        $data = [
            'title' => $this->request->getVar('title'),
            'price' => $this->request->getVar('price'),
        ];

        // cek apakah data sudah valid
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        // untuk memasukan data
        $model = new ProductModel();
        $model->save($data);
        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Data Inserted.'
            ]
        ];

        return $this->respondCreated($response);
    }



    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        // inisiasi validasi input update
        helper(['form']);
        $rules = [
            'title' => 'required',
            'price' => 'required'
        ];

        // mangambil data
        $data = [
            'title' => $this->request->getVar('title'),
            'price' => $this->request->getVar('price'),
        ];

        // cek apakah data sudah valid
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        // inisiasi model
        $model = new ProductModel();

        // cek apakah ada id
        $findById = $model->find(['id' => $id]);
        if (!$findById) return $this->failNotFound('No Data Found');

        // untuk update data
        $model->update($id, $data);
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data Updated.'
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
        // inisiasi model
        $model = new ProductModel();

        // cek apakah ada id
        $findById = $model->find(['id' => $id]);
        if (!$findById) return $this->failNotFound('No Data Found');

        // untuk delete data berdasarkan id
        $model->delete($id);
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data Deleted.'
            ]
        ];

        return $this->respond($response);
    }
}
