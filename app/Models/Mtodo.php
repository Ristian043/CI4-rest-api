<?php

namespace App\Models;

use CodeIgniter\Model;

class Mtodo extends Model
{
   protected $table = 'todo';

   public function getTodo($id = false)
   {
      if ($id === false) {
         return $this->findAll();
      } else {
         return $this->getWhere(['id' => $id])->getRowArray();
      }
   }

   public function insertTodo($data)
   {
      $query = $this->db->table($this->table)->insert($data);
      if ($query) {
         return true;
      } else {
         return false;
      }
   }

   public function updateTodo($data, $id)
   {
      return $this->db->table($this->table)->update($data, ['id' => $id]);
   }

   public function deleteTodo($id)
   {
      return $this->db->table($this->table)->delete(['id' => $id]);
   }
}
