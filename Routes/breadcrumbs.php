<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('admin.', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Admin', route('admin.'));
});

/****************************************** Http Error ******************************************/
Breadcrumbs::for('errors.401', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.');
    $trail->push('Unauthorized Access', route('errors.401'));
});

Breadcrumbs::for('errors.403', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.');
    $trail->push('Access Forbidden', route('errors.403'));
});

Breadcrumbs::for('errors.404', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.');
    $trail->push('Page Not Found');
});

Breadcrumbs::for('errors.419', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.');
    $trail->push('Page/Request Expired', route('errors.419'));
});

Breadcrumbs::for('errors.429', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.');
    $trail->push('Too Many Requests', route('errors.429'));
});

Breadcrumbs::for('errors.500', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.');
    $trail->push('Internal Server Error', route('errors.500'));
});

Breadcrumbs::for('errors.503', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.');
    $trail->push('Service Unavailable', route('errors.503'));
});
