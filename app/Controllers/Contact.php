<?php

namespace App\Controllers;

use App\Models\ContactModel;

class Contact extends BaseController
{
    public function contact()
    {
        return view('frontend/contact', [
            'title' => 'Hubungi Kami | TWILL Studio',
            'lang'  => session()->get('lang') ?? 'id'
        ]);
    }

    public function send_inquiry()
    {
        $rules = [
            'name'         => 'required|min_length[3]',
            'email'        => 'required|valid_email',
            'whatsapp'     => 'required|min_length[9]',
            'location'     => 'required',
            'project_info' => 'required'
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata(['errors' => $this->validator->getErrors()]);
            return redirect()->back()->withInput();
        }

        $name        = $this->request->getPost('name');
        $email       = $this->request->getPost('email');
        $whatsapp    = $this->request->getPost('whatsapp');
        $location    = $this->request->getPost('location');
        $projectInfo = $this->request->getPost('project_info');

        $contactModel = new ContactModel();
        $contactModel->save([
            'name'         => (string) $name,
            'email'        => (string) $email,
            'whatsapp'     => (string) $whatsapp,
            'location'     => (string) $location,
            'project_info' => (string) $projectInfo
        ]);

        $emailService = \Config\Services::email();
        
        $emailService->setTo('twillarchitettura@gmail.com');
        $emailService->setFrom('twillarchitettura@gmail.com', 'Twill New Project');
        $emailService->setReplyTo((string) $email, (string) $name);
        $emailService->setSubject('New Design Inquiry from ' . $name);

        $message = "
            <h3>New Design Inquiry Submitted</h3>
            <p>Anda mendapatkan pesan inquiry baru dari website. Berikut detailnya:</p>
            <table border='0' cellpadding='5'>
                <tr><td><strong>Name</strong></td><td>: {$name}</td></tr>
                <tr><td><strong>Email</strong></td><td>: {$email}</td></tr>
                <tr><td><strong>WhatsApp</strong></td><td>: {$whatsapp}</td></tr>
                <tr><td><strong>Location</strong></td><td>: {$location}</td></tr>
            </table>
            <br>
            <p><strong>Project Information:</strong></p>
            <p style='background-color: #f9f9f9; padding: 15px; border-left: 4px solid #C5A059;'>
                " . nl2br(esc((string) $projectInfo)) . "
            </p>
        ";

        $emailService->setMessage($message);

        if ($emailService->send()) {
            $lang = session()->get('lang') ?? 'id';
            session()->setFlashdata('success', lang('Contact.success_msg', [], $lang));
            return redirect()->to('contact');
        }

        $lang = session()->get('lang') ?? 'id';
        session()->setFlashdata('error', lang('Contact.error_msg', [], $lang));
        return redirect()->back()->withInput();
    }
}