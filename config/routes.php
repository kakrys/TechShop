<?php

use Core\Routing\Router;

Router::get('/', [new Up\Controllers\IndexController(), 'indexAction']);
Router::get('/product/:id/', [new Up\Controllers\DetailController(), 'detailsAction']);
