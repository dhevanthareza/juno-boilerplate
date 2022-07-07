<?php

namespace App\Http\Controllers;

class KaryawanController extends Controller
{
    public function index(){
        return view('karyawan::index');
        // return view('instansi.resik');
    }

    public function tespost(){
        return response()->json([
            [
                'id' => 1,
                'nama' => 'Pandu', 
                'email' => 'pandu@dnt.com',
                'jabatan' => 'Manager',
                'bagian' => 'Organization',
                'status' => 'ONLINE',
                'tanggal' => '23/04/18'
            ],
            [
                'id' => 5,
                'nama' => 'Dhevan', 
                'email' => 'dhevan@dnt.com',
                'jabatan' => 'Programator',
                'bagian' => 'Developer',
                'status' => 'ONLINE',
                'tanggal' => '23/04/18'
            ],
            [
                'id' => 2,
                'nama' => 'Pandu', 
                'email' => 'pandu@dnt.com',
                'jabatan' => 'Manager',
                'bagian' => 'Organization',
                'status' => 'ONLINE',
                'tanggal' => '23/04/18'
            ],
            [
                'id' => 4,
                'nama' => 'Dhevan', 
                'email' => 'dhevan@dnt.com',
                'jabatan' => 'Programator',
                'bagian' => 'Developer',
                'status' => 'ONLINE',
                'tanggal' => '23/04/18'
            ],
        ]);
    }
}