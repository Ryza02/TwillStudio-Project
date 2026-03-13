<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectGalleryModel extends Model
{
    protected $table            = 'project_galleries';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['project_id', 'image_url', 'sort_order'];
}