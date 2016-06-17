<?php

Route::group(['middleware' => 'auth', 'namespace' => 'Profio\Auth\Controller'], function () {
    ## Roles
    Route::get('role', ['as' => 'role.manage', 'uses' => 'RoleController@index']);
    Route::get('role/create', ['as' => 'role.manage', 'uses' => 'RoleController@create']);
    Route::post('role/create', ['as' => 'role.manage', 'uses' => 'RoleController@store']);
    Route::get('role/edit/{id}', ['as' => 'role.manage', 'uses' => 'RoleController@edit']);
    Route::post('role/edit/{id}', ['as' => 'role.manage', 'uses' => 'RoleController@update']);
    Route::get('role/delete/{id}', ['as' => 'role.manage', 'uses' => 'RoleController@destroy']);
    Route::get('role/menu/{id}', ['as' => 'role.manage', 'uses' => 'RoleController@manageMenu']);
    Route::post('role/menu/{id}', ['as' => 'role.manage', 'uses' => 'RoleController@manageMenu']);

    ## Menu
    Route::get('menu', ['as' => 'menu.manage', 'uses' => 'MenuController@index']);
    Route::get('menu/create', ['as' => 'menu.manage', 'uses' => 'MenuController@create']);
    Route::post('menu/create', ['as' => 'menu.manage', 'uses' => 'MenuController@store']);
    Route::get('menu/edit/{id}', ['as' => 'menu.manage', 'uses' => 'MenuController@edit']);
    Route::post('menu/edit/{id}', ['as' => 'menu.manage', 'uses' => 'MenuController@update']);
    Route::get('menu/delete/{id}', ['as' => 'menu.manage', 'uses' => 'MenuController@destroy']);

    ## Permission
    Route::get('permission', ['as' => 'permission.manage', 'uses' => 'PermissionController@index']);
    Route::get('permission/create', ['as' => 'permission.manage', 'uses' => 'PermissionController@create']);
    Route::post('permission/create', ['as' => 'permission.manage', 'uses' => 'PermissionController@store']);
    Route::get('permission/edit/{id}', ['as' => 'permission.manage', 'uses' => 'PermissionController@edit']);
    Route::post('permission/edit/{id}', ['as' => 'permission.manage', 'uses' => 'PermissionController@update']);
    Route::get('permission/delete/{id}', ['as' => 'permission.manage', 'uses' => 'PermissionController@destroy']);

    ## Workflow
    Route::get('workflow', ['as' => 'workflow.manage', 'uses' => 'WorkflowController@index']);
    Route::get('workflow/create', ['as' => 'workflow.manage', 'uses' => 'WorkflowController@create']);
    Route::post('workflow/create', ['as' => 'workflow.manage', 'uses' => 'WorkflowController@store']);
    Route::get('workflow/edit/{id}', ['as' => 'workflow.manage', 'uses' => 'WorkflowController@edit']);
    Route::post('workflow/edit/{id}', ['as' => 'workflow.manage', 'uses' => 'WorkflowController@update']);
    Route::get('workflow/mapping/{id}', ['as' => 'workflow.manage', 'uses' => 'WorkflowController@mapping']);
    Route::post('workflow/mapping/{id}', ['as' => 'workflow.manage', 'uses' => 'WorkflowController@mapping']);
    Route::get('workflow/delete/{id}', ['as' => 'workflow.manage', 'uses' => 'WorkflowController@destroy']);

});
