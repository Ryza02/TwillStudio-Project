<?php
namespace App\Controllers;

use App\Models\AboutHeroModel;
use App\Models\AboutItemModel;

class AboutAdmin extends BaseController
{
    protected $heroModel;
    protected $itemModel;

    public function __construct()
    {
        $this->heroModel = new AboutHeroModel();
        $this->itemModel = new AboutItemModel();
    }

    public function index()
    {
        $data = [
            'hero'  => $this->heroModel->find(1),
            'items' => $this->itemModel->orderBy('sort_order', 'ASC')->orderBy('id', 'DESC')->findAll()
        ];
        return view('admin/about/index', $data);
    }

    public function updateHero()
    {
        $data = [
            'title_id' => $this->request->getPost('title_id'),
            'title_en' => $this->request->getPost('title_en'),
            'title_it' => $this->request->getPost('title_it'),
            'desc_id'  => $this->request->getPost('desc_id'),
            'desc_en'  => $this->request->getPost('desc_en'),
            'desc_it'  => $this->request->getPost('desc_it'),
        ];
        
        $this->heroModel->update(1, $data);
        return redirect()->to('admin/about')->with('success', 'Data Hero berhasil diperbarui.');
    }

    public function updateOrder()
    {
        $orders = $this->request->getPost('order');
        if ($orders) {
            foreach ($orders as $id => $sort_order) {
                $this->itemModel->update($id, ['sort_order' => $sort_order]);
            }
            return redirect()->to('admin/about')->with('success', 'Urutan berhasil disimpan.');
        }
        return redirect()->to('admin/about');
    }

    public function createItem()
    {
        return view('admin/about/create');
    }

    public function saveItem()
    {
        $validationRule = [
            'image' => [
                'rules'  => 'uploaded[image]|is_image[image]|max_size[image,10240]',
                'errors' => [
                    'uploaded' => 'Gambar wajib diunggah.',
                    'is_image' => 'File yang diunggah harus berupa gambar.',
                    'max_size' => 'Ukuran gambar maksimal 10MB.'
                ]
            ],
        ];

        if (! $this->validate($validationRule)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getError('image'));
        }

        $data = [
            'title_id'   => $this->request->getPost('title_id'),
            'title_en'   => $this->request->getPost('title_en'),
            'title_it'   => $this->request->getPost('title_it'),
            'desc_id'    => $this->request->getPost('desc_id'),
            'desc_en'    => $this->request->getPost('desc_en'),
            'desc_it'    => $this->request->getPost('desc_it'),
            'sort_order' => 99,
        ];

        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move('assets/images', $newName);
            $data['image_url'] = 'assets/images/' . $newName;
        }

        $this->itemModel->insert($data);
        return redirect()->to('admin/about')->with('success', 'Item baru berhasil ditambahkan.');
    }

    public function editItem($id)
    {
        $data['item'] = $this->itemModel->find($id);
        if (!$data['item']) return redirect()->to('admin/about');
        
        return view('admin/about/edit', $data);
    }

    public function updateItem($id)
    {
        $data = [
            'title_id' => $this->request->getPost('title_id'),
            'title_en' => $this->request->getPost('title_en'),
            'title_it' => $this->request->getPost('title_it'),
            'desc_id'  => $this->request->getPost('desc_id'),
            'desc_en'  => $this->request->getPost('desc_en'),
            'desc_it'  => $this->request->getPost('desc_it'),
        ];

        $image = $this->request->getFile('image');
        
        if ($image && $image->isValid()) {
            $validationRule = [
                'image' => [
                    'rules'  => 'is_image[image]|max_size[image,10240]',
                    'errors' => [
                        'is_image' => 'File yang diunggah harus berupa gambar.',
                        'max_size' => 'Ukuran gambar maksimal 10MB.'
                    ]
                ],
            ];

            if (! $this->validate($validationRule)) {
                return redirect()->back()->withInput()->with('error', $this->validator->getError('image'));
            }

            if (!$image->hasMoved()) {
                $oldItem = $this->itemModel->find($id);
                if ($oldItem && !empty($oldItem['image_url']) && file_exists(FCPATH . $oldItem['image_url'])) {
                    unlink(FCPATH . $oldItem['image_url']);
                }

                $newName = $image->getRandomName();
                $image->move('assets/images', $newName);
                $data['image_url'] = 'assets/images/' . $newName;
            }
        }

        $this->itemModel->update($id, $data);
        return redirect()->to('admin/about')->with('success', 'Item berhasil diperbarui.');
    }

    public function deleteItem($id)
    {
        $item = $this->itemModel->find($id);
        
        if ($item && !empty($item['image_url']) && file_exists(FCPATH . $item['image_url'])) {
            unlink(FCPATH . $item['image_url']);
        }

        $this->itemModel->delete($id);
        
        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['status' => 'success']);
        }
        
        return redirect()->to('admin/about');
    }
}