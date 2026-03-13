<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model
{
    protected $table            = 'blogs';
    protected $primaryKey       = 'id';
    
    protected $allowedFields    = [
        'title', 
        'title_en', 
        'title_it',
        'slug', 
        'description_1', 
        'description_1_en', 
        'description_1_it', 
        'description_2', 
        'description_2_en',
        'description_2_it', 
        'image_url', 
        'is_featured'
    ];

    protected $useTimestamps    = true; 
}