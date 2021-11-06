<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Modules\Admin\Models\Rbac\Permission;
use Modules\Admin\Models\Rbac\Role;

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

Breadcrumbs::for('admin.roles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('Roles', route('admin.roles.index'));
});

Breadcrumbs::for('admin.roles.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.roles.index');
    $trail->push('Add Role', route('admin.roles.create'));
});

Breadcrumbs::for('admin.roles.show', function (BreadcrumbTrail $trail, Role $role) {
    $trail->parent('admin.roles.index');
    $trail->push($role->name, route('admin.roles.show', $role->id));
});

Breadcrumbs::for('admin.roles.edit', function (BreadcrumbTrail $trail, Role $role) {
    $trail->parent('admin.roles.index');
    $trail->push('Edit Role', route('admin.roles.edit', $role->id));
});
