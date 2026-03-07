<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model
{
    protected $table            = 'blogs';
    protected $primaryKey       = 'id';
    
    // Daftarkan kolom yang boleh diisi (content diganti)
    protected $allowedFields    = ['title', 'title_en', 'slug', 'description_1', 'description_1_en', 
    'description_2', 'description_2_en', 'image_url', 'is_featured'];

    protected $useTimestamps    = true; // Aktifkan created_at & updated_at
}