<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model
{
  protected $table  = 'blogs';
  protected $allowedFields = ['title', 'description', 'slug', 'created_at', 'updated_at'];
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $useTimestamps = true;

  public function list_pagination($limit, $offset, $sort, $order, $search) {
    $db = \Config\Database::connect();
    $builder = $db->table('blogs')->orderBy($sort, $order)->like('name', $search);
    $query = $builder->get($limit, $offset);
    $rows = $query->getResult();
    return $rows;
  }


  public function list() {
    $db = \Config\Database::connect();
    $builder = $db->table('blogs')->orderBy('id', 'desc');
    $query = $builder->get();
    $rows = $query->getResult();
    return $rows;
  }

  public function findById($id) {
    $db = \Config\Database::connect();
    $builder = $db->table('blogs')->where('id', $id);
    $query = $builder->get();
    $row = $query->getRow();
    return $row;
  }
}