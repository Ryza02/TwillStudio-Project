<?php

namespace App\Controllers;

use App\Models\BlogModel;

class Blog extends BaseController
{
    private BlogModel $blogModel;

    public function __construct()
    {
        // Load helper secara otomatis
        helper(['url', 'form']);
        $this->blogModel = new BlogModel();
    }

    /**
     * ADMIN: Listing semua blog
     * Route: admin/blogs
     */
    public function index()
    {
        return view('admin/blogs', [
            'blogs' => $this->blogModel->orderBy('created_at', 'DESC')->findAll(),
        ]);
    }

    /**
     * ADMIN: Create blog baru
     * Route: admin/blog/create (GET & POST)
     */
    public function create()
    {
        if ($this->request->is('post')) {
            $rules = [
                'title'            => 'required|min_length[5]|max_length[255]',
                'title_en'         => 'permit_empty|max_length[255]',
                'description_1'    => 'required|min_length[10]',
                'description_1_en' => 'permit_empty',
                'description_2'    => 'permit_empty',
                'description_2_en' => 'permit_empty',
                'image_url'        => 'uploaded[image_url]|is_image[image_url]|mime_in[image_url,image/jpg,image/jpeg,image/png,image/webp]|max_size[image_url,10240]'
            ];

            if (! $this->validate($rules)) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', $this->validator->getErrors())
                    ->with('error', 'Validasi gagal! Periksa kembali isian form Anda.');
            }

            // Handle Upload Gambar
            $file = $this->request->getFile('image_url');
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/blogs', $newName);

            $title = trim((string)$this->request->getPost('title'));
            $is_featured = $this->request->getPost('is_featured') ? 1 : 0;

            // Jika dijadikan Featured (Headline), matikan featured yang lain
            if ($is_featured == 1) {
                $this->blogModel->set('is_featured', 0)->where('is_featured', 1)->update();
            }

            $data = [
                'title'            => $title,
                'title_en'         => trim((string)$this->request->getPost('title_en')),
                'slug'             => url_title($title, '-', true),
                'description_1'    => trim((string)$this->request->getPost('description_1')),
                'description_1_en' => trim((string)$this->request->getPost('description_1_en')),
                'description_2'    => trim((string)$this->request->getPost('description_2')),
                'description_2_en' => trim((string)$this->request->getPost('description_2_en')),
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

    /**
     * ADMIN: Edit blog
     * Route: admin/blog/edit/{id} (GET & POST)
     */
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
                'description_1'    => 'required|min_length[10]',
                'description_1_en' => 'permit_empty',
                'description_2'    => 'permit_empty',
                'description_2_en' => 'permit_empty',
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

                // Hapus foto lama
                if (is_file(FCPATH . $blog['image_url'])) {
                    @unlink(FCPATH . $blog['image_url']);
                }
            }

            $title = trim((string)$this->request->getPost('title'));
            $is_featured = $this->request->getPost('is_featured') ? 1 : 0;

            // Jika dijadikan Featured, matikan featured lain (kecuali current id)
            if ($is_featured == 1) {
                $this->blogModel->set('is_featured', 0)->where('is_featured', 1)->where('id !=', $id)->update();
            }

            $data = [
                'title'            => $title,
                'title_en'         => trim((string)$this->request->getPost('title_en')),
                'slug'             => url_title($title, '-', true),
                'description_1'    => trim((string)$this->request->getPost('description_1')),
                'description_1_en' => trim((string)$this->request->getPost('description_1_en')),
                'description_2'    => trim((string)$this->request->getPost('description_2')),
                'description_2_en' => trim((string)$this->request->getPost('description_2_en')),
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

    /**
     * ADMIN: Delete blog
     * Route: admin/blog/delete/{id}
     */
    public function delete($id)
    {
        $blog = $this->blogModel->find($id);
        
        if ($blog) {
            // Hapus file gambar jika ada
            if (!empty($blog['image_url']) && is_file(FCPATH . $blog['image_url'])) {
                @unlink(FCPATH . $blog['image_url']);
            }
            
            $this->blogModel->delete($id);
            
            return redirect()->to(base_url('admin/blogs'))->with('success', 'Artikel berhasil dihapus.');
        }
        
        return redirect()->back()->with('error', 'Artikel tidak ditemukan.');
    }

    /**
     * ADMIN: Toggle Featured (AJAX)
     * Route: admin/blog/toggle-featured/{id} (POST)
     */
    public function toggleFeatured($id)
    {
        // Pastikan request adalah AJAX
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

        // Matikan semua featured terlebih dahulu (hanya yang sedang featured)
        $this->blogModel->set('is_featured', 0)->where('is_featured', 1)->update();

        // Aktifkan yang dipilih
        $this->blogModel->update($id, ['is_featured' => 1]);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Master blog berhasil diubah.',
            'blog_id' => $id
        ]);
    }
}