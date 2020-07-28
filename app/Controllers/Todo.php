<?php

namespace App\Controllers;

use App\Models\Mtodo;
use CodeIgniter\RESTful\ResourceController;

class Todo extends ResourceController
{
   protected $format = 'json';
   protected $modelName = 'use App\Models\Mtodo';

   public function __construct()
   {
      $this->mtodo = new Mtodo();
   }

   public function index()
   {
      $mtodo = $this->mtodo->getTodo();

      foreach ($mtodo as $row) {
         $mtodo_all[] = [
            'id' => intval($row['id']),
            'judul' => $row['judul'],
            'deskripsi' => $row['deskripsi'],
            'jadwal_selesai' => $row['jadwal_selesai'],
         ];
      }

      return $this->respond($mtodo_all, 200);
   }

   public function create()
   {
      $judul = $this->request->getPost('judul');
      $deskripsi = $this->request->getPost('deskripsi');
      $jadwal_selesai = $this->request->getPost('jadwal_selesai');

      $data = [
         'judul' => $judul,
         'deskripsi' => $deskripsi,
         'jadwal_selesai' => $jadwal_selesai
      ];

      $simpan = $this->mtodo->insertTodo($data);

      if ($simpan == true) {
         $output = [
            'status' => 200,
            'message' => 'Berhasil menyimpan data',
            'data' => ''
         ];
         return $this->respond($output, 200);
      } else {
         $output = [
            'status' => 400,
            'message' => 'Gagal menyimpan data',
            'data' => ''
         ];
         return $this->respond($output, 400);
      }
   }

   public function show($id = null)
   {
      $mtodo = $this->mtodo->getTodo($id);

      if (!empty($mtodo)) {
         $output = [
            'id' => intval($mtodo['id']),
            'judul' => $mtodo['judul'],
            'deskripsi' => $mtodo['deskripsi'],
            'jadwal_selesai' => $mtodo['jadwal_selesai'],
         ];

         return $this->respond($output, 200);
      } else {
         $output = [
            'status' => 400,
            'message' => 'Data tidak ditemukan',
            'data' => ''
         ];

         return $this->respond($output, 400);
      }
   }

   public function edit($id = null)
   {
      $mtodo = $this->mtodo->getTodo($id);

      if (!empty($mtodo)) {
         $output = [
            'id' => intval($mtodo['id']),
            'judul' => $mtodo['judul'],
            'deskripsi' => $mtodo['deskripsi'],
            'jadwal_selesai' => $mtodo['jadwal_selesai'],
         ];

         return $this->respond($output, 200);
      } else {
         $output = [
            'status' => 400,
            'message' => 'Data tidak ditemukan',
            'data' => ''
         ];
         return $this->respond($output, 400);
      }
   }

   public function update($id = null)
   {
      // menangkap data dari method PUT, DELETE
      $data = $this->request->getRawInput();

      // cek data berdasarkan id
      $mtodo = $this->mtodo->getTodo($id);

      //cek todo
      if (!empty($mtodo)) {
         // update data
         $updateTodo = $this->mtodo->updateTodo($data, $id);

         $output = [
            'status' => true,
            'data' => '',
            'message' => 'sukses melakukan update'
         ];

         return $this->respond($output, 200);
      } else {
         $output = [
            'status' => false,
            'data' => '',
            'message' => 'gagal melakukan update'
         ];

         return $this->respond($output, 400);
      }
   }

   public function delete($id = null)
   {
      // cek data berdasarkan id
      $mtodo = $this->mtodo->getTodo($id);

      //cek todo
      if (!empty($mtodo)) {
         // delete data
         $deleteTodo = $this->mtodo->deleteTodo($id);

         $output = [
            'status' => true,
            'data' => '',
            'message' => 'sukses hapus data'
         ];

         return $this->respond($output, 200);
      } else {
         $output = [
            'status' => false,
            'data' => '',
            'message' => 'gagal hapus data'
         ];

         return $this->respond($output, 400);
      }
   }

   //--------------------------------------------------------------------

}
