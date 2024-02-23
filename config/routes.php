<?php

use Core\Routing\Router;

use Up\Controllers\UserController;
use Up\Controllers\AdminController;
use Up\Controllers\OrderController;
use Up\Controllers\IndexController;
use Up\Controllers\DetailController;
use Up\Controllers\CatalogController;
use Up\Controllers\RegistrationController;
use Up\Controllers\AuthorizationController;

Router::get('/', [new IndexController(), 'indexAction']);
Router::get('/catalog/:tag/:id/', [new CatalogController(), 'catalogAction']);
Router::get('/product/:id/', [new DetailController(), 'detailsAction']);
Router::get('/login/', [new AdminController(), 'loginAction']);
Router::get('/admin/', [new AdminController(), 'adminAction']);
Router::get('/order/:id/', [new OrderController(), 'orderAction']);
Router::post('/success/', [new OrderController(), 'successAction']);
Router::post('/login/', [new AuthorizationController(), 'authAction']);
Router::get('/login/logout', [new AuthorizationController(), 'logOutAction']);
Router::post('/admin/create/product/', [new AdminController(), 'addProductAction']);

//new =)
Router::get('/account/', [new UserController(), 'userAction']);
Router::post('/registration/', [new RegistrationController(), 'registrationAction']);
Router::post('/catalog/:tag/:id/', [new CatalogController(), 'catalogAction']);
Router::post('/account/', [new UserController(), 'updateInfoAction']);

//fetch-api
Router::post('/remove/', [new AdminController(), 'removeProductAction']);
Router::post('/removeUser/', [new AdminController(), 'removeUserAction']);
Router::post('/addWishItem/', [new CatalogController(), 'addWishItemAction']);
Router::post('/update/product/', [new AdminController(), 'updateProductAction']);
Router::post('/changeStatus/', [new AdminController(), 'changeProductStatus']);
Router::post('/removeWishItem/', [new UserController(), 'removeWishItemAction']);


