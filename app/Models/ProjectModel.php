<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table      = 'projects'; // Sesuaikan dengan nama tabel Anda
    protected $primaryKey = 'id';
    
    // Field diperbarui untuk mendukung multi-bahasa (_id dan _en)
    protected $allowedFields = [
        'title_id', 
        'title_en', 
        'subtitle_id',
        'subtitle_en',
        'category', 
        'location', 
        'year', 
        'image_url', 
        'description_1_id', 
        'description_1_en',
        'description_2_id',
        'description_2_en',
        'is_featured' 
    ];
}