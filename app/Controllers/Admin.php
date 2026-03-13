<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\AdminModel;
use App\Models\BlogModel;
use App\Models\CategoryModel;
use App\Models\ProjectGalleryModel;

class Admin extends BaseController
{
    protected function postString(string $key): string
    {
        $val = $this->request->getPost($key);
        if (is_string($val)) return trim($val);
        if (is_scalar($val)) return trim((string) $val);
        return '';
    }

    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to(site_url('admin/dashboard'));
        }

        if ($this->request->is('post')) {
            $rules = [
                'username' => 'required',
                'password' => 'required'
            ];

            if (! $this->validate($rules)) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', $this->validator->getErrors());
            }

            $username = $this->postString('username');
            $password = (string) $this->request->getPost('password');

            $adminModel = new AdminModel();
            $admin = $adminModel->where('username', $username)->first();

            if ($admin && password_verify($password, $admin['password'])) {
                session()->set([
                    'id'         => $admin['id'],
                    'username'   => $admin['username'],
                    'isLoggedIn' => true,
                ]);

                return redirect()->to(site_url('admin/dashboard'))
                    ->with('success', 'Selamat datang, ' . $admin['username'] . '!');
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Username atau password salah.');
        }

        return view('admin/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('admin/login'))
            ->with('success', 'Anda berhasil logout.');
    }

    public function dashboard()
    {
        $projectModel = new ProjectModel();
        $blogModel = new BlogModel();
        $categoryModel = new CategoryModel();
        $galleryModel = new ProjectGalleryModel();

        $data = [
            'total_projects' => $projectModel->countAll(),
            'total_blogs' => $blogModel->countAll(),
            'total_categories' => $categoryModel->countAll(),
            'total_gallery' => $galleryModel->countAll(),
            'recent_blogs' => $blogModel->orderBy('created_at', 'DESC')->findAll(3),
            'recent_gallery' => $galleryModel->orderBy('id', 'DESC')->findAll(6),
        ];

        return view('admin/dashboard', $data);
    }

    public function translate()
    {
        $json = $this->request->getJSON(true);
        if (!$json) {
            return $this->response->setJSON(['success' => false, 'message' => 'No data provided']);
        }

        $targetLang = $this->request->getGet('lang') ?? 'en';
        
        if (isset($json['target_lang'])) {
            $targetLang = $json['target_lang'];
            unset($json['target_lang']); 
        }

        $results = [];
        try {
            $context = stream_context_create([
                "http" => [
                    "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)\r\n"
                ]
            ]);

            foreach ($json as $key => $text) {
                if (!empty($text)) {
                    $url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=id&tl=" . urlencode($targetLang) . "&dt=t&q=" . urlencode($text);
                    $res = file_get_contents($url, false, $context);
                    
                    if ($res === false) {
                        throw new \Exception("Gagal menghubungi server terjemahan Google.");
                    }

                    $resArray = json_decode($res);
                    $translatedText = "";
                    
                    if (isset($resArray[0]) && is_array($resArray[0])) {
                        foreach ($resArray[0] as $part) {
                            $translatedText .= $part[0];
                        }
                    }

                    $results[$key] = trim($translatedText);
                } else {
                    $results[$key] = "";
                }
            }

            return $this->response->setJSON([
                'success' => true,
                'data'    => $results
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}