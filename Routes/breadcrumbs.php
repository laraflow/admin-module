<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Modules\Admin\Models\Rbac\Permission;
use Modules\Admin\Models\Rbac\Role;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

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

/****************************************** Permission ******************************************/
Breadcrumbs::for('admin.permissions.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.');
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

/****************************************** Role ******************************************/
Breadcrumbs::for('admin.roles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.');
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

/****************************************** User ******************************************/
Breadcrumbs::for('admin.users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.');
    $trail->push('Users', route('admin.users.index'));
});

Breadcrumbs::for('admin.users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.users.index');
    $trail->push('Add User', route('admin.users.create'));
});

Breadcrumbs::for('admin.users.show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.users.index');
    $trail->push($user->name, route('admin.users.show', $user->id));
});

Breadcrumbs::for('admin.users.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.users.index');
    $trail->push('Edit User', route('admin.users.edit', $user->id));
});

/****************************************** User ******************************************/
Breadcrumbs::for('admin.system-logs', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.');
    $trail->push('System Logs', route('admin.system-logs'));
});
