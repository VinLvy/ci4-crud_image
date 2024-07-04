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

    public function store()
    {
        $model = new MahasiswaModel();

        $fotoDiri = $this->request->getFile('foto_diri');
        $fotoKtp = $this->request->getFile('foto_ktp');

        if ($fotoDiri->isValid() && !$fotoDiri->hasMoved()) {
            $fotoDiriName = $fotoDiri->getRandomName();
            $fotoDiri->move('uploads/foto_diri', $fotoDiriName);
        }

        if ($fotoKtp->isValid() && !$fotoKtp->hasMoved()) {
            $fotoKtpName = $fotoKtp->getRandomName();
            $fotoKtp->move('uploads/foto_ktp', $fotoKtpName);
        }

        $model->insert([
            'nim' => $this->request->getPost('nim'),
            'nama' => $this->request->getPost('nama'),
            'foto_diri' => $fotoDiriName,
            'foto_ktp' => $fotoKtpName,
        ]);

        return redirect()->to('/mahasiswa');
    }

    public function edit($id)
    {
        $model = new MahasiswaModel();
        $data['mahasiswa'] = $model->find($id);

        return view('mahasiswa/edit', $data);
    }

    public function update($id)
    {
        $model = new MahasiswaModel();
        
        $fotoDiri = $this->request->getFile('foto_diri');
        $fotoKtp = $this->request->getFile('foto_ktp');
        
        $data = [
            'nim' => $this->request->getPost('nim'),
            'nama' => $this->request->getPost('nama'),
        ];

        if ($fotoDiri->isValid() && !$fotoDiri->hasMoved()) {
            $fotoDiriName = $fotoDiri->getRandomName();
            $fotoDiri->move('uploads/foto_diri', $fotoDiriName);
            $data['foto_diri'] = $fotoDiriName;
        }

        if ($fotoKtp->isValid() && !$fotoKtp->hasMoved()) {
            $fotoKtpName = $fotoKtp->getRandomName();
            $fotoKtp->move('uploads/foto_ktp', $fotoKtpName);
            $data['foto_ktp'] = $fotoKtpName;
        }

        $model->update($id, $data);

        return redirect()->to('/mahasiswa');
    }

    public function delete($id)
    {
        $model = new MahasiswaModel();
        $model->delete($id);

        return redirect()->to('/mahasiswa');
    }
}
