<?php

use Core\Routing\Router;

Router::get('/', [new Up\Controllers\IndexController(), 'indexAction']);
Router::get('/catalog/:tag/:id/', [new Up\Controllers\CatalogController(), 'catalogAction']);
//Router::get('/catalog/:tag/', [new Up\Controllers\CatalogController(), 'catalogAction']);
Router::get('/product/:id/', [new Up\Controllers\DetailController(), 'detailsAction']);
Router::get('/login/', [new Up\Controllers\AdminController(), 'loginAction']);
Router::post('/admin/:id/', [new Up\Controllers\AdminController(), 'adminAction']);
Router::get('/order/:id/', [new Up\Controllers\OrderController(), 'orderAction']);
Router::post('/success/', [new Up\Controllers\OrderController(), 'successAction']);
