<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'categories';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'name',
        'name_en',
        'name_it',
        'slug'
    ];
    protected $returnType       = 'array';
}
