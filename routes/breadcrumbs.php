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

//breadcrumbs brands
Breadcrumbs::register('admin.brands.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('Danh sách thương hiệu', route('admin.brands.index'));
});

Breadcrumbs::register('admin.brands.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.brands.index');
    $breadcrumbs->push('Thêm mới thương hiệu', route('admin.brands.create'));
});

Breadcrumbs::register('admin.brands.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.brands.index');
    $breadcrumbs->push('Chỉnh sửa thương hiệu', route('admin.brands.edit'));
});


//breadcrumbs products
Breadcrumbs::register('admin.products.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('Danh sách sản phẩm', route('admin.products.index'));
});

Breadcrumbs::register('admin.products.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.products.index');
    $breadcrumbs->push('Thêm mới sản phẩm', route('admin.products.create'));
});

Breadcrumbs::register('admin.products.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.products.index');
    $breadcrumbs->push('Chỉnh sửa sản phẩm', route('admin.products.edit'));
});


//breadcrumbs banners
Breadcrumbs::register('admin.banners.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('Danh sách banner', route('admin.banners.index'));
});

Breadcrumbs::register('admin.banners.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.banners.index');
    $breadcrumbs->push('Thêm mới banner', route('admin.banners.create'));
});

Breadcrumbs::register('admin.banners.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.banners.index');
    $breadcrumbs->push('Chỉnh sửa banner', route('admin.banners.edit'));
});