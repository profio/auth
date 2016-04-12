<?php

Route::group(['namespace' => 'Profio\Auth\Controller'], function () {
    ## Roles

    get('role', ['middleware' => 'permission:manage-role', 'uses' => 'RoleController@index']);
    get('role/create', ['middleware' => 'permission:create-role', 'uses' => 'RoleController@create']);
    post('role/create', ['middleware' => 'permission:create-role', 'uses' => 'RoleController@store']);
    get('role/edit/{id}', ['middleware' => 'permission:edit-role', 'uses' => 'RoleController@edit']);
    post('role/edit/{id}', ['middleware' => 'permission:edit-role', 'uses' => 'RoleController@update']);
    get('role/delete/{id}', ['middleware' => 'permission:delete-role', 'uses' => 'RoleController@destroy']);

    ## Menu

    get('menu', ['middleware' => 'permission:manage-menu', 'uses' => 'MenuController@index']);
    get('menu/create', ['middleware' => 'permission:create-menu', 'uses' => 'MenuController@create']);
    post('menu/create', ['middleware' => 'permission:create-menu', 'uses' => 'MenuController@store']);
    get('menu/edit/{id}', ['middleware' => 'permission:edit-menu', 'uses' => 'MenuController@edit']);
    post('menu/edit/{id}', ['middleware' => 'permission:edit-menu', 'uses' => 'MenuController@update']);
    get('menu/delete/{id}', ['middleware' => 'permission:delete-menu', 'uses' => 'MenuController@destroy']);

    ## Permission

    get('permission', ['middleware' => 'permission:manage-permission', 'uses' => 'PermissionController@index']);
    get('permission/create', ['middleware' => 'permission:create-permission', 'uses' => 'PermissionController@create']);
    post('permission/create', ['middleware' => 'permission:create-permission', 'uses' => 'PermissionController@store']);
    get('permission/edit/{id}', ['middleware' => 'permission:edit-permission', 'uses' => 'PermissionController@edit']);
    post('permission/edit/{id}', ['middleware' => 'permission:edit-permission', 'uses' => 'PermissionController@update']);
    get('permission/delete/{id}', ['middleware' => 'permission:delete-permission', 'uses' => 'PermissionController@destroy']);

    ## Workflow
    get('workflow', ['middleware' => 'permission:manage-workflow', 'uses' => 'WorkflowController@index']);
    get('workflow/create', ['middleware' => 'permission:create-workflow', 'uses' => 'WorkflowController@create']);
    post('workflow/create', ['middleware' => 'permission:create-workflow', 'uses' => 'WorkflowController@store']);
    get('workflow/edit/{id}', ['middleware' => 'permission:edit-workflow', 'uses' => 'WorkflowController@edit']);
    post('workflow/edit/{id}', ['middleware' => 'permission:edit-workflow', 'uses' => 'WorkflowController@update']);
    get('workflow/mapping/{id}', ['middleware' => 'permission:mapping-workflow', 'uses' => 'WorkflowController@mapping']);
    post('workflow/mapping/{id}', ['middleware' => 'permission:mapping-workflow', 'uses' => 'WorkflowController@mapping']);
    get('workflow/delete/{id}', ['middleware' => 'permission:delete-workflow', 'uses' => 'WorkflowController@destroy']);

});
