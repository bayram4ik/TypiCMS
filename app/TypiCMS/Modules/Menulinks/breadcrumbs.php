<?php

// Menulinks

Breadcrumbs::register('admin.menus.menulinks.index', function ($breadcrumbs, $menu) {
    $breadcrumbs->parent('admin.menus.edit', $menu);
    $breadcrumbs->push(Str::title(trans('menulinks::global.name')), route('admin.menus.menulinks.index', $menu->id));
});

Breadcrumbs::register('admin.menus.menulinks.edit', function ($breadcrumbs, $menu, $menulink) {
    $breadcrumbs->parent('admin.menus.menulinks.index', $menu);
    $breadcrumbs->push($menulink->title, route('admin.menus.index'));
});

Breadcrumbs::register('admin.menus.menulinks.create', function ($breadcrumbs, $menu) {
    $breadcrumbs->parent('admin.menus.menulinks.index', $menu);
    $breadcrumbs->push(trans('menulinks::global.New'), route('admin.menus.index'));
});
