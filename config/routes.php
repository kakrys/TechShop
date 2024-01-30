<?php

use Core\Routing\Router;

Router::get('/main/:tag/', [new Up\Controllers\IndexController(), 'indexAction']);
Router::get('/product/:id/', [new Up\Controllers\DetailController(), 'detailsAction']);
Router::get('/admin/:id/', [new Up\Controllers\AdminController(), 'adminAction']);
Router::get('/order/:id/', [new Up\Controllers\OrderController(), 'orderAction']);
Router::get('/auth/', [new Up\Controllers\AuthController(), 'authAction']);
