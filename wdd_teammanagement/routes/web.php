<?php

use Illuminate\Support\Facades\Route;
// use wdd\teammanagement\Http\Controllers\DashboardController;
use wdd\teammanagement\Http\Controllers\ToDoController;
use wdd\teammanagement\Http\Controllers\Admin\Auth\LoginController;
use wdd\teammanagement\Http\Controllers\Admin\EmployeeController;
use wdd\teammanagement\Http\Controllers\Admin\TaskController;
use wdd\teammanagement\Http\Controllers\Admin\DepartmentController;
use wdd\teammanagement\Http\Controllers\Admin\AdminController;
use wdd\teammanagement\Http\Controllers\Admin\DashboardController;


// Route::middleware(['web'])->group(function () {
//     Route::get('ss', [TeammMnagementController::class, 'in']);
//     Route::get('aaa', [TeammMnagementController::class, 'render']);
// });





// _____________________________________________________



Route::prefix('admin')->group(function () {
    Route::middleware(['guest:admin'])->group(function () {
            });

    Route::middleware(['auth:admin'])->group(function () {


        
        
        
        
    });
});
Route::get('/login', [LoginController::class, 'index'])->name('admin.login');
        Route::post('/login', [LoginController::class, 'login']);
        Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        // Admin routes

Route::get('/admin/list', [AdminController::class, 'index'])->name('admin.admin.list');
Route::get('/admin/add', [AdminController::class, 'add'])->name('admin.admin.add');
Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.admin.store');
Route::post('/admin/delete', [AdminController::class, 'delete'])->name('admin.admin.delete');
Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.admin.edit');
Route::post('/admin/update', [AdminController::class, 'update'])->name('admin.admin.update');

        // Employee routes

Route::get('/employee/list', [EmployeeController::class, 'index'])->name('admin.employee.list');
        Route::get('/employee/add', [EmployeeController::class, 'add'])->name('admin.employee.add');
        Route::post('/employee/create', [EmployeeController::class, 'create'])->name('admin.employee.create');
        Route::post('/employee/delete', [EmployeeController::class, 'delete'])->name('admin.employee.delete');
        Route::get('/employee/edit/{id}', [EmployeeController::class, 'edit'])->name('admin.employee.edit');
        Route::post('/employee/update', [EmployeeController::class, 'update'])->name('admin.employee.update');



        // Department routes

        Route::get('/departments/list', [DepartmentController::class, 'index'])->name('admin.department.list');
        Route::get('/departments/add', [DepartmentController::class, 'add'])->name('admin.department.add');
        Route::post('/departments/store', [DepartmentController::class, 'store'])->name('admin.department.store');
        Route::post('/departments/delete', [DepartmentController::class, 'delete'])->name('admin.department.delete');
        Route::get('/departments/edit/{id}', [DepartmentController::class, 'edit'])->name('admin.department.edit');
        Route::post('/departments/update', [DepartmentController::class, 'update'])->name('admin.department.update');
        // Task routes
        Route::get('/tasks/list', [TaskController::class, 'index'])->name('admin.task.list');
        Route::get('/tasks/add', [TaskController::class, 'add'])->name('admin.task.add');
        Route::post('/tasks/create', [TaskController::class, 'create'])->name('admin.task.create');
        Route::post('/tasks/delete', [TaskController::class, 'delete'])->name('admin.task.delete');
        Route::get('/tasks/edit/{id}', [TaskController::class, 'edit'])->name('admin.task.edit');
        Route::post('/tasks/update', [TaskController::class, 'update'])->name('admin.task.update');