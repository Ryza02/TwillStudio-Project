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
        'title_it',     
        'subtitle_id',
        'subtitle_en',
        'subtitle_it',    
        'category', 
        'location', 
        'year', 
        'image_url', 
        'description_1_id', 
        'description_1_en',
        'description_1_it',
        'description_2_id',
        'description_2_en',
        'description_2_it', 
        'is_featured'
    ];
}