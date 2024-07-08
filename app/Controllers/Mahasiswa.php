<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use CodeIgniter\Controller;

class Mahasiswa extends Controller
{
    public function index()
    {
        $model = new MahasiswaModel();
        $data['mahasiswa'] = $model->findAll();

        return view('mahasiswa/index', $data);
    }

    public function create()
    {
        return view('mahasiswa/create');
    }

    // public function store()
    // {
    //     $model = new MahasiswaModel();

    //     $fotoDiriBase64 = $this->request->getPost('cropped_foto_diri');
    //     $fotoKtpBase64 = $this->request->getPost('cropped_foto_ktp');

    //     $fotoDiriName = null;
    //     $fotoKtpName = null;

    //     if ($fotoDiriBase64) {
    //         $fotoDiriName = $this->saveBase64Image($fotoDiriBase64, 'uploads/foto_diri');
    //     }

    //     if ($fotoKtpBase64) {
    //         $fotoKtpName = $this->saveBase64Image($fotoKtpBase64, 'uploads/foto_ktp');
    //     }

    //     $model->insert([
    //         'nim' => $this->request->getPost('nim'),
    //         'nama' => $this->request->getPost('nama'),
    //         'foto_diri' => $fotoDiriName,
    //         'foto_ktp' => $fotoKtpName,
    //     ]);

    //     return redirect()->to('/mahasiswa');
    // }

    public function store()
    {
        $validasi = \Config\Services::validation();
        $aturan = [
            'nim' => [
                'label' => 'NIM',
                'rules' => 'required|min_length[3]|max_length[8]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => '{field} harus terdiri dari 3 karakter',
                    'max_length' => '{field} harus terdiri dari 8 karakter'
                ]
            ],
            'nama' => [
                'label' => 'Nama',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimal 3 karakter untuk {field}'
                ]
            ],
            'cropped_foto_diri' => [
                'label' => 'Foto Diri',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'cropped_foto_ktp' => [
                'label' => 'Foto KTP',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
        ];

        $validasi->setRules($aturan);
        if ($validasi->withRequest($this->request)->run()) {
            $fotoDiriBase64 = $this->request->getPost('cropped_foto_diri');
            $fotoKtpBase64 = $this->request->getPost('cropped_foto_ktp');

            $fotoDiriName = $this->saveBase64Image($fotoDiriBase64, 'uploads/foto_diri');
            $fotoKtpName = $this->saveBase64Image($fotoKtpBase64, 'uploads/foto_ktp');

            $data = [
                'nim' => $this->request->getPost('nim'),
                'nama' => $this->request->getPost('nama'),
                'foto_diri' => $fotoDiriName,
                'foto_ktp' => $fotoKtpName,
            ];

            $model = new MahasiswaModel();
            $model->save($data);

            return redirect()->to('/mahasiswa');
        } else {
            return redirect()->back()->withInput()->with('errors', $validasi->getErrors());
        }
    }

    // public function store()
    // {
    //     $model = new MahasiswaModel();

    //     $fotoDiri = $this->request->getFile('foto_diri');
    //     $fotoKtp = $this->request->getFile('foto_ktp');

    //     if ($fotoDiri->isValid() && !$fotoDiri->hasMoved()) {
    //         $fotoDiriName = $fotoDiri->getRandomName();
    //         $fotoDiri->move('uploads/foto_diri', $fotoDiriName);
    //     }

    //     if ($fotoKtp->isValid() && !$fotoKtp->hasMoved()) {
    //         $fotoKtpName = $fotoKtp->getRandomName();
    //         $fotoKtp->move('uploads/foto_ktp', $fotoKtpName);
    //     }

    //     $model->insert([
    //         'nim' => $this->request->getPost('nim'),
    //         'nama' => $this->request->getPost('nama'),
    //         'foto_diri' => $fotoDiriName,
    //         'foto_ktp' => $fotoKtpName,
    //     ]);

    //     return redirect()->to('/mahasiswa');
    // }

    public function edit($id)
    {
        $model = new MahasiswaModel();
        $data['mahasiswa'] = $model->find($id);

        return view('mahasiswa/edit', $data);
    }

    public function update($id)
    {
        $validasi = \Config\Services::validation();
        $aturan = [
            'nim' => [
                'label' => 'NIM',
                'rules' => 'required|min_length[3]|max_length[8]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => '{field} harus terdiri dari 3 karakter',
                    'max_length' => '{field} harus terdiri dari 8 karakter'
                ]
            ],
            'nama' => [
                'label' => 'Nama',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimal 3 karakter untuk {field}'
                ]
            ]
        ];

        $validasi->setRules($aturan);
        if ($validasi->withRequest($this->request)->run()) {
            $model = new MahasiswaModel();

            $data = [
                'nim' => $this->request->getPost('nim'),
                'nama' => $this->request->getPost('nama'),
            ];

            $fotoDiriBase64 = $this->request->getPost('cropped_foto_diri');
            $fotoKtpBase64 = $this->request->getPost('cropped_foto_ktp');

            if ($fotoDiriBase64) {
                $fotoDiriName = $this->saveBase64Image($fotoDiriBase64, 'uploads/foto_diri');
                $data['foto_diri'] = $fotoDiriName;
            }

            if ($fotoKtpBase64) {
                $fotoKtpName = $this->saveBase64Image($fotoKtpBase64, 'uploads/foto_ktp');
                $data['foto_ktp'] = $fotoKtpName;
            }

            $model->update($id, $data);

            return redirect()->to('/mahasiswa');
        } else {
            return redirect()->back()->withInput()->with('errors', $validasi->getErrors());
        }
    }

    public function delete($id)
    {
        $model = new MahasiswaModel();
        $model->delete($id);

        return redirect()->to('/mahasiswa');
    }

    private function saveBase64Image($base64Image, $path)
    {
        $image_parts = explode(";base64,", $base64Image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1]; // Get the image type (e.g., jpeg, png)
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.' . $image_type; // Use the image type as the file extension
        $filePath = $path . '/' . $fileName;
        file_put_contents($filePath, $image_base64);
        return $fileName;
    }
}
