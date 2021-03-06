<?php

$di->set(
    'router',
    function () {
        $router = new \Phalcon\Mvc\Router(false);

        $router->mount(
            new BukuRoutes()
        );

        $router->mount(
            new PeminjamanRoutes()
        );

        $router->mount(
            new ReservasiRoutes()
        );

        $router->mount(
            new UsersRoutes()
        );

        $router->mount(
            new SessionRoutes()
        );

        $router->notFound([
            'controller'    => 'index',
            'action'        => 'show404'
        ]);

        $router->addGet(
            '/',
            [
                'controller'    => 'index',
                'action'        => 'index'
            ]
        );

        $router->addGet(
            '/catalogue',
            [
                'controller'    => 'index',
                'action'        => 'showBooks'
            ]
        );

        $router->addPost(
            '/catalogue',
            [
                'controller'    => 'index',
                'action'        => 'showBooks'
            ]
        );


        $router->addGet(
            '/details/{id}',
            [
                'controller'    => 'index',
                'action'        => 'showBookDetail'
            ]
        );
        
        $router->addGet(
            '/dashboard',
            [
                'controller'    => 'index',
                'action'        => 'indexAdmin'
            ]
        );

        return $router;
    }

    
);