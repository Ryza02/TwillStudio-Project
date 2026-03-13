<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\CategoryModel;
use App\Models\ProjectGalleryModel;

class Project extends BaseController
{
    private ProjectModel $projectModel;
    private CategoryModel $categoryModel;
    private ProjectGalleryModel $projectGalleryModel;

    public function __construct()
    {
        $this->projectModel = new ProjectModel();
        $this->categoryModel = new CategoryModel();
        $this->projectGalleryModel = new ProjectGalleryModel();
    }

    public function index()
    {
        return view('admin/projects', [
            'projects' => $this->projectModel->orderBy('year', 'DESC')->orderBy('id', 'DESC')->findAll(),
        ]);
    }

    public function create()
    {
        if ($this->request->is('post')) {
            $rules = [
                'title_id'         => 'required|min_length[3]|max_length[255]',
                'title_en'         => 'permit_empty|min_length[3]|max_length[255]',
                'description_1_id' => 'required',
                'description_1_en' => 'permit_empty',
                'location'         => 'required',
                'year'             => 'required|numeric',
                'category'         => 'required',
                'image_url'        => 'uploaded[image_url]|is_image[image_url]|mime_in[image_url,image/jpg,image/jpeg,image/png,image/webp]|max_size[image_url,10240]'
            ];

            if (! $this->validate($rules)) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', $this->validator->getErrors())
                    ->with('error', 'Validasi gagal! Periksa kembali isian form Anda.');
            }

            $file = $this->request->getFile('image_url');
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/projects', $newName);

            $is_featured = $this->request->getPost('is_featured') ? 1 : 0;

            if ($is_featured == 1) {
                $this->projectModel->set('is_featured', 0)->where('id >', 0)->update();
            }

            $data = [
                'title_id'         => trim((string)$this->request->getPost('title_id')),
                'title_en'         => trim((string)$this->request->getPost('title_en')),
                'title_it'         => trim((string)$this->request->getPost('title_it')),
                'subtitle_id'      => trim((string)$this->request->getPost('subtitle_id')),
                'subtitle_en'      => trim((string)$this->request->getPost('subtitle_en')),
                'subtitle_it'      => trim((string)$this->request->getPost('subtitle_it')),
                'description_1_id' => trim((string)$this->request->getPost('description_1_id')),
                'description_1_en' => trim((string)$this->request->getPost('description_1_en')),
                'description_1_it' => trim((string)$this->request->getPost('description_1_it')),
                'description_2_id' => trim((string)$this->request->getPost('description_2_id')),
                'description_2_en' => trim((string)$this->request->getPost('description_2_en')),
                'description_2_it' => trim((string)$this->request->getPost('description_2_it')),
                'location'         => trim((string)$this->request->getPost('location')),
                'year'             => trim((string)$this->request->getPost('year')),
                'category'         => trim((string)$this->request->getPost('category')),
                'image_url'        => 'uploads/projects/' . $newName,
                'is_featured'      => $is_featured,
            ];

            if ($this->projectModel->insert($data)) {
                return redirect()->to(site_url('admin/projects'))->with('success', 'Project berhasil ditambahkan!');
            }

            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan ke database.');
        }

        return view('admin/create-project', [
            'categories' => $this->categoryModel->findAll()
        ]);
    }

    public function edit($id)
    {
        $project = $this->projectModel->find($id);

        if (! $project) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Project tidak ditemukan.');
        }

        if ($this->request->is('post')) {
            $rules = [
                'title_id'         => 'required|min_length[3]|max_length[255]',
                'title_en'         => 'permit_empty|min_length[3]|max_length[255]',
                'description_1_id' => 'required',
                'description_1_en' => 'permit_empty',
                'location'         => 'required',
                'year'             => 'required|numeric',
                'category'         => 'required',
            ];

            $file = $this->request->getFile('image_url');
            $isUploadingNewImage = $file && $file->isValid() && ! $file->hasMoved();

            if ($isUploadingNewImage) {
                $rules['image_url'] = 'is_image[image_url]|mime_in[image_url,image/jpg,image/jpeg,image/png,image/webp]|max_size[image_url,10240]';
            }

            if (! $this->validate($rules)) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', $this->validator->getErrors())
                    ->with('error', 'Validasi gagal! Periksa kembali isian form Anda.');
            }

            $imageUrl = $project['image_url'];

            if ($isUploadingNewImage) {
                $newName = $file->getRandomName();
                $file->move(FCPATH . 'uploads/projects', $newName);
                $imageUrl = 'uploads/projects/' . $newName;

                $oldFilePath = FCPATH . ltrim((string)$project['image_url'], '/');
                if (is_file($oldFilePath)) {
                    @unlink($oldFilePath);
                }
            }

            $is_featured = $this->request->getPost('is_featured') ? 1 : 0;
            if ($is_featured == 1) {
                $this->projectModel->set('is_featured', 0)->where('id !=', $id)->update();
            }

            $data = [
                'title_id'         => trim((string)$this->request->getPost('title_id')),
                'title_en'         => trim((string)$this->request->getPost('title_en')),
                'title_it'         => trim((string)$this->request->getPost('title_it')),
                'subtitle_id'      => trim((string)$this->request->getPost('subtitle_id')),
                'subtitle_en'      => trim((string)$this->request->getPost('subtitle_en')),
                'subtitle_it'      => trim((string)$this->request->getPost('subtitle_it')),
                'description_1_id' => trim((string)$this->request->getPost('description_1_id')),
                'description_1_en' => trim((string)$this->request->getPost('description_1_en')),
                'description_1_it' => trim((string)$this->request->getPost('description_1_it')),
                'description_2_id' => trim((string)$this->request->getPost('description_2_id')),
                'description_2_en' => trim((string)$this->request->getPost('description_2_en')),
                'description_2_it' => trim((string)$this->request->getPost('description_2_it')),
                'location'         => trim((string)$this->request->getPost('location')),
                'year'             => trim((string)$this->request->getPost('year')),
                'category'         => trim((string)$this->request->getPost('category')),
                'image_url'        => $imageUrl,
                'is_featured'      => $is_featured,
            ];

            if ($this->projectModel->update($id, $data)) {
                return redirect()->to(site_url('admin/projects'))->with('success', 'Project berhasil diperbarui!');
            }

            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate database.');
        }

        return view('admin/edit-project', [
            'project'    => $project,
            'categories' => $this->categoryModel->findAll()
        ]);
    }

    public function delete($id)
    {
        $project = $this->projectModel->find($id);
        
        if ($project) {
            if (!empty($project['image_url']) && is_file(FCPATH . $project['image_url'])) {
                @unlink(FCPATH . $project['image_url']);
            }
            
            $this->projectModel->delete($id);
            
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Project berhasil dihapus.'
                ]);
            }
            
            return redirect()->to(base_url('admin/projects'))
                ->with('success', 'Project berhasil dihapus.');
        }
        
        if ($this->request->isAJAX()) {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Project tidak ditemukan.'
            ]);
        }
        
        return redirect()->back()->with('error', 'Project tidak ditemukan.');
    }

    public function toggleFeatured($id)
    {
        $project = $this->projectModel->find($id);
        if ($project) {
            $newStatus = $this->request->getJSON()->is_featured ?? 1;

            if ($newStatus == 1) {
                $countMaster = $this->projectModel->where('is_featured', 1)->countAllResults();
                if ($countMaster >= 4 && $project['is_featured'] != 1) {
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Maksimal hanya 4 project yang bisa dijadikan Master di Beranda.']);
                }
            }

            $this->projectModel->update($id, ['is_featured' => $newStatus]);
            return $this->response->setJSON(['status' => 'success']);
        }
        return $this->response->setJSON(['status' => 'error', 'message' => 'Project tidak ditemukan.']);
    }

    public function galleryIndex()
    {
        return view('admin/gallery-index', [
            'projects' => $this->projectModel->orderBy('created_at', 'DESC')->findAll(),
        ]);
    }

    public function gallery($id)
    {
        $project = $this->projectModel->find($id);
        
        if (! $project) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Project tidak ditemukan.');
        }

        return view('admin/project-gallery', [
            'project'   => $project,
            'galleries' => $this->projectGalleryModel->where('project_id', $id)->orderBy('sort_order', 'ASC')->findAll()
        ]);
    }

    public function uploadGallery($id)
    {
        $project = $this->projectModel->find($id);
        if (! $project) {
            return redirect()->back()->with('error', 'Project tidak ditemukan.');
        }

        if ($this->request->is('post')) {
            $rules = [
                'images' => 'uploaded[images]|is_image[images]|mime_in[images,image/jpg,image/jpeg,image/png,image/webp]|max_size[images,10240]'
            ];

            if (! $this->validate($rules)) {
                 return redirect()->back()->with('error', 'Validasi gagal! Pastikan semua file adalah gambar dengan ukuran maks 10MB.');
            }

            $files = $this->request->getFileMultiple('images');
            $uploadedCount = 0;

            if ($files) {
                $lastItem = $this->projectGalleryModel->where('project_id', $id)->orderBy('sort_order', 'DESC')->first();
                $lastOrder = $lastItem ? (int)$lastItem['sort_order'] : 0;

                foreach ($files as $file) {
                    if ($file->isValid() && ! $file->hasMoved()) {
                        $newName = $file->getRandomName();
                        $file->move(FCPATH . 'uploads/project_galleries', $newName);
                        
                        $lastOrder++;

                        $this->projectGalleryModel->insert([
                            'project_id' => $id,
                            'image_url'  => 'uploads/project_galleries/' . $newName,
                            'sort_order' => $lastOrder
                        ]);
                        
                        $uploadedCount++;
                    }
                }

                if ($uploadedCount > 0) {
                    return redirect()->back()->with('success', "$uploadedCount foto berhasil ditambahkan ke galeri.");
                }
            }

            return redirect()->back()->with('error', 'Gagal mengupload foto.');
        }
    }

    public function reorderGallery()
    {
        $json = $this->request->getJSON();
        if (isset($json->order) && is_array($json->order)) {
            foreach ($json->order as $index => $id) {
                $this->projectGalleryModel->update($id, ['sort_order' => $index]);
            }
            return $this->response->setJSON(['status' => true]);
        }
        return $this->response->setJSON(['status' => false], 400);
    }

    public function deleteGallery($id)
    {
        $gallery = $this->projectGalleryModel->find($id);

        if ($gallery) {
            $filePath = FCPATH . ltrim((string) $gallery['image_url'], '/');
            if (is_file($filePath)) {
                @unlink($filePath);
            }

            $this->projectGalleryModel->delete($id);
            
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['status' => 'success']);
            }

            return redirect()->back()->with('success', 'Foto berhasil dihapus dari galeri.');
        }

        if ($this->request->isAJAX()) {
            return $this->response->setStatusCode(404)->setJSON(['status' => 'error']);
        }

        return redirect()->back()->with('error', 'Foto tidak ditemukan atau sudah dihapus.');
    }
}