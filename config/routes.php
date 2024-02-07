<?php

use Core\Routing\Router;

Router::get('/', [new Up\Controllers\IndexController(), 'indexAction']);
Router::get('/catalog/:tag/:id/', [new Up\Controllers\CatalogController(), 'catalogAction']);
Router::get('/product/:id/', [new Up\Controllers\DetailController(), 'detailsAction']);
Router::get('/login/', [new Up\Controllers\AdminController(), 'loginAction']);
Router::get('/admin/', [new Up\Controllers\AdminController(), 'adminAction']);
Router::get('/order/:id/', [new Up\Controllers\OrderController(), 'orderAction']);
Router::post('/success/', [new Up\Controllers\OrderController(), 'successAction']);
Router::post('/login/auth', [new Up\Controllers\AuthorizationController(), 'authAction']);
Router::get('/login/logout', [new Up\Controllers\AuthorizationController(), 'logOutAction']);
Router::post('/admin/create/product/', [new Up\Controllers\AdminController(), 'addProductAction']);

//new =)
Router::get('/account/', [new \Up\Controllers\UserController(), 'userAction']);
Router::post('/registration/', [new Up\Controllers\RegistrationController(), 'registrationAction']);

//fetch-api
Router::post('/product/remove/',[new \Up\Controllers\AdminController(), 'removeAction']);
Router::post('/migrations/execute/', [new \Up\Controllers\AdminController(), 'executeAction']);
Router::post('/database/delete/', [new \Up\Controllers\AdminController(), 'dbAction']);
