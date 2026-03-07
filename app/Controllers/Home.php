<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\ProjectGalleryModel;
use App\Models\BlogModel;
use App\Models\CategoryModel;

class Home extends BaseController
{
    public function switchLanguage($lang)
    {
        if (in_array($lang, ['id', 'en'])) {
            session()->set('lang', $lang);
        }

        $referrer = $this->request->getHeaderLine('Referer');

        if (!empty($referrer) && strpos($referrer, base_url('admin')) === false) {
            return redirect()->to($referrer);
        }

        return redirect()->to(base_url());
    }

    public function index()
    {
        $lang = session()->get('lang') ?? 'id';
        $projectModel = new ProjectModel();

        $projects = $projectModel->where('is_featured', 1)->orderBy('id', 'DESC')->findAll(4);

        if (count($projects) < 4) {
            $limit = 4 - count($projects);
            $excludeIds = array_column($projects, 'id');

            if (empty($excludeIds)) {
                $additional = $projectModel->orderBy('id', 'DESC')->findAll($limit);
            } else {
                $additional = $projectModel->whereNotIn('id', $excludeIds)->orderBy('id', 'DESC')->findAll($limit);
            }
            $projects = array_merge($projects, $additional);
        }

        return view('frontend/home', [
            'title'    => 'Beranda | TWILL Architecture',
            'projects' => $projects,
            'lang'     => $lang
        ]);
    }

    public function about()
    {
        return view('frontend/about', [
            'title' => 'Tentang Kami | TWILL Architecture',
            'lang'  => session()->get('lang') ?? 'id'
        ]);
    }

    public function projects()
    {
        $projectModel  = new ProjectModel();
        $categoryModel = new CategoryModel();

        $projects = $projectModel->orderBy('year', 'DESC')->findAll();
        $categories = $categoryModel->findAll();

        return view('frontend/projects', [
            'title'      => 'Portfolio Kami | TWILL Architecture',
            'projects'   => $projects,
            'categories' => $categories,
            'lang'       => session()->get('lang') ?? 'id'
        ]);
    }

    public function projectDetail($id)
    {
        $projectModel = new ProjectModel();
        $galleryModel = new ProjectGalleryModel();
        $lang = session()->get('lang') ?? 'id';

        $project = $projectModel->find($id);

        if (!$project) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Project tidak ditemukan');
        }

        $pageTitle = ($lang === 'id') ? $project['title_id'] : $project['title_en'];

        $galleries = $galleryModel->where('project_id', $id)->findAll();

        return view('frontend/project-detail', [
            'title'     => $pageTitle . ' | TWILL Architecture',
            'project'   => $project,
            'galleries' => $galleries,
            'lang'      => $lang
        ]);
    }

    public function blog()
    {
        $blogModel = new BlogModel();
        $lang = session()->get('lang') ?? 'id';

        $featured_blog = $blogModel->where('is_featured', 1)->first();

        if ($featured_blog) {
            $blogs = $blogModel
                ->where('id !=', $featured_blog['id'])
                ->orderBy('created_at', 'DESC')
                ->findAll();
        } else {
            $blogs = $blogModel->orderBy('created_at', 'DESC')->findAll();
        }

        return view('frontend/blog', [
            'title'         => 'Blog & Berita | TWILL Architecture',
            'featured_blog' => $featured_blog,
            'blogs'         => $blogs,
            'lang'          => $lang
        ]);
    }

    public function blogDetail($slug)
    {
        $blogModel = new BlogModel();
        $lang = session()->get('lang') ?? 'id';

        $blog = $blogModel->where('slug', $slug)->first();

        if (! $blog) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Artikel tidak ditemukan');
        }

        $pageTitle = ($lang === 'id') ? $blog['title'] : $blog['title_en'];

        return view('frontend/blog-detail', [
            'title' => $pageTitle . ' | TWILL Architecture',
            'blog'  => $blog,
            'lang'  => $lang
        ]);
    }

    public function contact()
    {
        return view('frontend/contact', [
            'title' => 'Hubungi Kami | TWILL Architecture',
            'lang'  => session()->get('lang') ?? 'id'
        ]);
    }
}
