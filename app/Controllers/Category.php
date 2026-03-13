<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class Category extends BaseController
{
    private CategoryModel $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        return view('admin/categories', [
            'categories' => $this->categoryModel->orderBy('id', 'DESC')->findAll()
        ]);
    }

    public function store()
    {
        if ($this->request->is('post')) {
            $name = trim((string)$this->request->getPost('name'));
            $name_en = trim((string)$this->request->getPost('name_en'));
            $name_it = trim((string)$this->request->getPost('name_it'));
            
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));

            if (!empty($name)) {
                $this->categoryModel->insert([
                    'name'    => $name,
                    'name_en' => $name_en,
                    'name_it' => $name_it,
                    'slug'    => $slug
                ]);
                return redirect()->to(site_url('admin/categories'))->with('success', 'Kategori berhasil ditambahkan!');
            }
        }
        return redirect()->back()->with('error', 'Nama kategori tidak boleh kosong.');
    }

    public function update()
    {
        if ($this->request->is('post')) {
            $id = $this->request->getPost('id');
            $name = trim((string)$this->request->getPost('name'));
            $name_en = trim((string)$this->request->getPost('name_en'));
            $name_it = trim((string)$this->request->getPost('name_it'));
            
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));

            if (!empty($name) && !empty($id)) {
                $this->categoryModel->update($id, [
                    'name'    => $name,
                    'name_en' => $name_en,
                    'name_it' => $name_it,
                    'slug'    => $slug
                ]);
                return redirect()->to(site_url('admin/categories'))->with('success', 'Kategori berhasil diperbarui!');
            }
        }
        return redirect()->back()->with('error', 'Gagal memperbarui kategori.');
    }

    public function delete($id)
    {
        if ($this->categoryModel->delete($id)) {
            return redirect()->to(site_url('admin/categories'))->with('success', 'Kategori berhasil dihapus!');
        }
        return redirect()->back()->with('error', 'Gagal menghapus kategori.');
    }
}