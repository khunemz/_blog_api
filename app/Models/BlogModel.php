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
}