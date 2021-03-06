<?php
/**
 * Back end table headers 
 */
HTML::macro('th', function ($field = '', $defaultOrder = null, $sortable = true, $label = true) {
    $inputs = Input::all();

    $order = Input::get('order');
    if ($defaultOrder and ! $order) { // set default column active
        $order = $field;
    }
    $direction = Input::get('direction', $defaultOrder);
    $th[] = '<th class="' . $field . '">';
    if ($sortable) {
        $inputs['direction'] = 'asc';
        $iconDir = ' text-muted'; // column not active, gray icons
        if ($order == $field) { // if this column is active
            if ($direction == 'asc') { // reverse direction
                $inputs['direction'] = 'desc';
            }
            $iconDir = '-' . $inputs['direction'];
        }
        $inputs['order'] = $field;
        $th[] = '<a href="?' . http_build_query($inputs) . '">';
        $th[] = '<i class="fa fa-sort' . $iconDir . '"></i> ';
    }
    if ($label) {
        $th[] = trans('validation.attributes.' . $field);
    }
    if ($sortable) {
        $th[] = '</a>';
    }
    $th[] = '</th>';
    $th[] = "\r\n";

    return implode($th);
});

/**
 * Back end buttons in view list 
 */
HTML::macro('langButton', function ($locale = null) {

    $inputs = Input::except('locale');
    $inputs['locale'] = $locale;

    $attributes['class'] = 'btn btn-default btn-xs';
    if ($locale == Config::get('app.locale')) {
        $attributes['class'] .= ' active';
    }
    $label = trans('global.languages.' . $locale);
    $attributes['href'] = '?' . http_build_query($inputs);

    return '<a ' . HTML::attributes($attributes) . '>' . $label . '</a>';

});

/**
 * Front end lang switcher 
 */
HTML::macro('languagesMenu', function (array $langsArray = array(), array $attributes = array()) {

    $attributes['role'] = 'menu';
    $attributes = HTML::attributes($attributes);

    $html = array();
    $html[] = '<ul ' . $attributes . '>';
    foreach ($langsArray as $item) {
        $html[] = '<li class="' . $item->class . '" role="menuitem">';
        $html[] = '<a href="' . $item->url . '">' . $item->lang . '</a>';
        $html[] = '</li>';
    }
    $html[] = '</ul>';

    return implode("\r\n", $html);

});

/**
 * Front end menu
 */
HTML::macro('menu', $builtMenu = function ($items = array(), $ulAttr = array()) use (&$builtMenu) {
    // dd($items);
    $menuList = array('<ul ' . HTML::attributes($ulAttr) . '>');

    foreach ($items as $item) {

        $liAttr = array();
        $item->class and $liAttr['class'] = $item->class;
        $liAttr['role'] = 'menuitem';

        // item
        $menuList[] = '<li ' . HTML::attributes($liAttr) . '>';

        $aAttr = array();
        if ($item->children) {
            $aAttr['class'] = 'dropdown-toggle';
            $aAttr['data-toggle'] = 'dropdown';
        }
        $item->target and $aAttr['target'] = $item->target;
        $aAttr['href'] = $item->page_uri;

        $menuList[] = '<a ' . HTML::attributes($aAttr) . '>';
        $menuList[] = $item->title;
        $item->children and $menuList[] = '<span class="caret"></span>';
        $menuList[] = '</a>';

        // nested list
        if ($item->children) {
            $menuList[] = $builtMenu($item->children, array('class' => 'dropdown-menu'));
        }

        $menuList[] = '</li>';
    }
    $menuList[] = '</ul>';

    return implode("\r\n", $menuList);

});
