<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Modern Office Complex',
                'description' => 'Sebuah kompleks perkantoran modern dengan desain minimalis. Bangunan ini menampilkan arsitektur kontemporer dengan penggunaan material berkualitas tinggi dan teknologi hijau. Proyek ini menggabungkan fungsi dan estetika untuk menciptakan ruang kerja yang inspiratif dan produktif.',
                'image_url' => 'assets/images/project-1.jpg',
                'gallery_images' => json_encode(['assets/images/project-1.jpg']),
                'year' => 2023,
                'location' => 'Jakarta, Indonesia',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Luxury Residential Tower',
                'description' => 'Gedung apartemen mewah dengan fitur-fitur premium. Setiap unit dirancang dengan perhatian terhadap detail dan kenyamanan maksimal. Tower ini menawarkan pemandangan kota yang spektakuler dan fasilitas world-class untuk penghuni.',
                'image_url' => 'assets/images/project-2.jpg',
                'gallery_images' => json_encode(['assets/images/project-2.jpg']),
                'year' => 2022,
                'location' => 'Surabaya, Indonesia',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Contemporary Interior Design',
                'description' => 'Proyek interior design untuk rumah mewah dengan konsep minimalis modern. Ruang dirancang dengan mempertimbangkan aliran cahaya alami, fungsionalitas, dan estetika kontemporer. Setiap elemen dipilih dengan cermat untuk menciptakan harmoni visual.',
                'image_url' => 'assets/images/project-3.jpg',
                'gallery_images' => json_encode(['assets/images/project-3.jpg']),
                'year' => 2023,
                'location' => 'Bandung, Indonesia',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Commercial Shopping Center',
                'description' => 'Pusat perbelanjaan komersial dengan desain arsitektur modern. Fasilitas ini menggabungkan retail space, food court, dan entertainment area dalam satu kompleks yang terintegrasi dengan baik.',
                'image_url' => 'assets/images/project-4.jpg',
                'gallery_images' => json_encode(['assets/images/project-4.jpg']),
                'year' => 2021,
                'location' => 'Medan, Indonesia',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Fine Dining Restaurant',
                'description' => 'Restoran fine dining dengan konsep interior mewah dan elegan. Setiap detail dari pencahayaan hingga pemilihan material mencerminkan kualitas premium dan pengalaman kuliner kelas dunia.',
                'image_url' => 'assets/images/project-5.jpg',
                'gallery_images' => json_encode(['assets/images/project-5.jpg']),
                'year' => 2022,
                'location' => 'Bali, Indonesia',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Boutique Hotel',
                'description' => 'Hotel boutique dengan konsep desain kontemporer dan hospitality terbaik. Setiap kamar dirancang untuk memberikan pengalaman menginap yang tak terlupakan dengan sentuhan personal dan kenyamanan maksimal.',
                'image_url' => 'assets/images/project-6.jpg',
                'gallery_images' => json_encode(['assets/images/project-6.jpg']),
                'year' => 2023,
                'location' => 'Yogyakarta, Indonesia',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('projects')->insertBatch($data);
    }
}
