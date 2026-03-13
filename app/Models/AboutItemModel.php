<?php
namespace App\Models;
use CodeIgniter\Model;

class AboutItemModel extends Model {
    protected $table = 'about_items';
    protected $allowedFields = ['image_url', 'title_id', 'title_en', 'title_it', 'desc_id', 'desc_en', 'desc_it', 'sort_order'];
}