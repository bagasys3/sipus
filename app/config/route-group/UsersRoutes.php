<?php

use \Phalcon\Mvc\Router\Group as RouterGroup;

class UsersRoutes extends RouterGroup
{
    public function initialize()
    {
        $this->setPaths([
            'controller' => 'users',
        ]);

        $this->addGet(
            '/daftar-anggota',
            [
                'action'    => 'manage',
            ]
        );

        $this->addPost(
            '/daftar-anggota',
            [
                'action'    => 'manage',
            ]
        );

        $this->addGet(
            '/tambah-anggota',
            [
                'action'    => 'create',
            ]
        );

        $this->addGet(
            '/ubah-anggota/{id}',
            [
                'action'    => 'edit',
            ]
        );

        $this->addPost(
            '/tambah-anggota',
            [
                'action'    => 'create',
            ]
        );

        $this->addPost(
            '/ubah-anggota',
            [
                'action'    => 'update',
            ]
        );

        $this->addPost(
            '/hapus-anggota',
            [
                'action'    => 'destroy',
            ]
        );
       
        
    }
}