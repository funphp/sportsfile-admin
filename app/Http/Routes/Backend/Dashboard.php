<?php

get('dashboard', 'DashboardController@index')->name('backend.dashboard');
/*get('users', function () {
    require_once(public_path() ."/phpgrid/conf.php");

$dg = new C_DataGrid("SELECT * FROM users_tbl", "user_id", "name","email");
$dg->enable_edit("INLINE", "CRUD");
$dg->enable_autowidth(true)->enable_autoheight(true);
$dg->set_theme('cobalt-flat');
$dg->display(false);

$grid = $dg -> get_display(true); // do not include required javascript libraries until later with with display_script_includeonce method.
return view('backend.users', ['grid' => $grid]);
});*/
get('users', 'DashboardController@users')->name('backend.users');
get('edit-user/{id?}', 'DashboardController@edit_user')->name('backend.edit-user');
post('update-user', 'DashboardController@update_user')->name('backend.update-user');