<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Modules\Admin\Models\Rbac\Permission;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('admin', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Admin', route('admin.'));
});

Breadcrumbs::for('admin.permissions.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('Permissions', route('admin.permissions.index'));
});

Breadcrumbs::for('admin.permissions.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.permissions.index');
    $trail->push('Add Permission', route('admin.permissions.create'));
});

Breadcrumbs::for('admin.permissions.show', function (BreadcrumbTrail $trail, Permission $permission) {
    $trail->parent('admin.permissions.index');
    $trail->push($permission->display_name, route('admin.permissions.show', $permission->id));
});

Breadcrumbs::for('admin.permissions.edit', function (BreadcrumbTrail $trail, Permission $permission) {
    $trail->parent('admin.permissions.index');
    $trail->push('Edit Permission', route('admin.permissions.edit', $permission->id));
});
