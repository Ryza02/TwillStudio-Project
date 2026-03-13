<?php

namespace App\Controllers;

use App\Models\BlogModel;

class Blog extends BaseController
{
    private BlogModel $blogModel;

    public function __construct()
    {
        helper(['url', 'form']);
        $this->blogModel = new BlogModel();
    }

    public function index()
    {
        return view('admin/blogs', [
            'blogs' => $this->blogModel->orderBy('created_at', 'DESC')->findAll(),
        ]);
    }

    public function create()
    {
        if ($this->request->is('post')) {
            $rules = [
                'title'            => 'required|min_length[5]|max_length[255]',
                'title_en'         => 'permit_empty|max_length[255]',
                'title_it'         => 'permit_empty|max_length[255]',
                'description_1'    => 'required|min_length[10]',
                'description_1_en' => 'permit_empty',
                'description_1_it' => 'permit_empty',
                'description_2'    => 'permit_empty',
                'description_2_en' => 'permit_empty',
                'description_2_it' => 'permit_empty',
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
            $file->move(FCPATH . 'uploads/blogs', $newName);

            $title = trim((string)$this->request->getPost('title'));
            $is_featured = $this->request->getPost('is_featured') ? 1 : 0;

            if ($is_featured == 1) {
                $this->blogModel->set('is_featured', 0)->where('is_featured', 1)->update();
            }

            $data = [
                'title'            => $title,
                'title_en'         => trim((string)$this->request->getPost('title_en')),
                'title_it'         => trim((string)$this->request->getPost('title_it')),
                'slug'             => url_title($title, '-', true),
                'description_1'    => trim((string)$this->request->getPost('description_1')),
                'description_1_en' => trim((string)$this->request->getPost('description_1_en')),
                'description_1_it' => trim((string)$this->request->getPost('description_1_it')),
                'description_2'    => trim((string)$this->request->getPost('description_2')),
                'description_2_en' => trim((string)$this->request->getPost('description_2_en')),
                'description_2_it' => trim((string)$this->request->getPost('description_2_it')),
                'image_url'        => 'uploads/blogs/' . $newName,
                'is_featured'      => $is_featured,
            ];

            if ($this->blogModel->insert($data)) {
                return redirect()->to(base_url('admin/blogs'))->with('success', 'Berita blog berhasil dipublikasikan!');
            }

            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan ke database.');
        }

        return view('admin/create-blog');
    }

    public function edit($id)
    {
        $blog = $this->blogModel->find($id);

        if (! $blog) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Artikel tidak ditemukan.');
        }

        if ($this->request->is('post')) {
            $rules = [
                'title'            => 'required|min_length[5]|max_length[255]',
                'title_en'         => 'permit_empty|max_length[255]',
                'title_it'         => 'permit_empty|max_length[255]',
                'description_1'    => 'required|min_length[10]',
                'description_1_en' => 'permit_empty',
                'description_1_it' => 'permit_empty',
                'description_2'    => 'permit_empty',
                'description_2_en' => 'permit_empty',
                'description_2_it' => 'permit_empty',
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
                    ->with('error', 'Validasi gagal!');
            }

            $imageUrl = $blog['image_url'];

            if ($isUploadingNewImage) {
                $newName = $file->getRandomName();
                $file->move(FCPATH . 'uploads/blogs', $newName);
                $imageUrl = 'uploads/blogs/' . $newName;

                if (is_file(FCPATH . $blog['image_url'])) {
                    @unlink(FCPATH . $blog['image_url']);
                }
            }

            $title = trim((string)$this->request->getPost('title'));
            $is_featured = $this->request->getPost('is_featured') ? 1 : 0;

            if ($is_featured == 1) {
                $this->blogModel->set('is_featured', 0)->where('is_featured', 1)->where('id !=', $id)->update();
            }

            $data = [
                'title'            => $title,
                'title_en'         => trim((string)$this->request->getPost('title_en')),
                'title_it'         => trim((string)$this->request->getPost('title_it')),
                'slug'             => url_title($title, '-', true),
                'description_1'    => trim((string)$this->request->getPost('description_1')),
                'description_1_en' => trim((string)$this->request->getPost('description_1_en')),
                'description_1_it' => trim((string)$this->request->getPost('description_1_it')),
                'description_2'    => trim((string)$this->request->getPost('description_2')),
                'description_2_en' => trim((string)$this->request->getPost('description_2_en')),
                'description_2_it' => trim((string)$this->request->getPost('description_2_it')),
                'image_url'        => $imageUrl,
                'is_featured'      => $is_featured,
            ];

            if ($this->blogModel->update($id, $data)) {
                return redirect()->to(base_url('admin/blogs'))->with('success', 'Artikel berhasil diperbarui!');
            }

            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate database.');
        }

        return view('admin/edit-blog', ['blog' => $blog]);
    }

    public function delete($id)
    {
        $blog = $this->blogModel->find($id);
        
        if ($blog) {
            if (!empty($blog['image_url']) && is_file(FCPATH . $blog['image_url'])) {
                @unlink(FCPATH . $blog['image_url']);
            }
            
            $this->blogModel->delete($id);
            
            return redirect()->to(base_url('admin/blogs'))->with('success', 'Artikel berhasil dihapus.');
        }
        
        return redirect()->back()->with('error', 'Artikel tidak ditemukan.');
    }

    public function toggleFeatured($id)
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method.'
            ]);
        }

        $blog = $this->blogModel->find($id);
        
        if (! $blog) {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Artikel tidak ditemukan.'
            ]);
        }

        $this->blogModel->set('is_featured', 0)->where('is_featured', 1)->update();
        $this->blogModel->update($id, ['is_featured' => 1]);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Master blog berhasil diubah.',
            'blog_id' => $id
        ]);
    }
}