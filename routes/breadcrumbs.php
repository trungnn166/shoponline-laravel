<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::register('admin.dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('Trang quản lý', route('admin.dashboard'));
});


//breadcrumbs categories
Breadcrumbs::register('admin.categories.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('Danh sách danh mục', route('admin.categories.index'));
});

Breadcrumbs::register('admin.categories.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.categories.index');
    $breadcrumbs->push('Thêm mới danh mục', route('admin.categories.create'));
});

Breadcrumbs::register('admin.categories.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.categories.index');
    $breadcrumbs->push('Chỉnh sửa danh mục', route('admin.categories.edit'));
});

