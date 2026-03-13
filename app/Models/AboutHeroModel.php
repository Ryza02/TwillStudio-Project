<?php
namespace App\Models;
use CodeIgniter\Model;

class AboutHeroModel extends Model {
    protected $table = 'about_hero';
    protected $allowedFields = ['title_id', 'title_en', 'title_it', 'desc_id', 'desc_en', 'desc_it'];
}