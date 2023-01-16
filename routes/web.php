<?php

use App\Http\Controllers\ArmController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GradeRemarkController;
use App\Http\Controllers\GradeSettingController;
use App\Http\Controllers\RemarkController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('staff.login');
});

Route::prefix('/staff')->group(function () {
    Route::get('/login', [StaffController::class, 'login'])->name('staff.login');
    Route::post('/login', [StaffController::class, 'authenticate'])->name('staff.authenticate');

    Route::group(['middleware' => 'auth.staff'], function () {
        Route::get('/dashboard', [StaffController::class, 'dashboard'])->name('staff.dashboard');
        // Sections Routes
        Route::get('/sections', [StaffController::class, 'sections'])->name('staff.sections');
        Route::post('/sections', [SectionController::class, 'store'])->name('staff.sections.store');
        Route::post('/sections/update', [SectionController::class, 'update'])->name('staff.sections.update');
        Route::get('/sections/delete/{id}', [SectionController::class, 'destroy'])->name('staff.sections.delete');
        // Classes/Forms Routes
        Route::get('/classes', [StaffController::class, 'classes'])->name('staff.classes');
        // Arms Routes
        Route::get('/arms', [StaffController::class, 'arms'])->name('staff.arms');
        Route::post('/arms', [ArmController::class, 'store'])->name('staff.arms.store');
        Route::post('/arms/update', [ArmController::class, 'update'])->name('staff.arms.update');
        Route::get('/arms/delete/{id}', [ArmController::class, 'destroy'])->name('staff.arms.delete');
        //Subjects routes
        Route::get('/subjects', [StaffController::class, 'subjects'])->name('staff.subjects');
        Route::post('/subjects', [SubjectController::class, 'store'])->name('staff.subject.store');
        Route::post('/subjects/update', [SubjectController::class, 'update'])->name('staff.subject.update');
        Route::get('/subjects/delete/{id}', [SubjectController::class, 'destroy'])->name('staff.subject.destroy');
        //Grades Routes
        Route::get('grades', [StaffController::class, 'grades'])->name('staff.grades');
        Route::post('/grades', [GradeSettingController::class, 'store'])->name('staff.grade.store');
        Route::post('/grades/update', [GradeSettingController::class, 'update'])->name('staff.grade.update');
        Route::get('/grades/delete/{id}', [GradeSettingController::class, 'destroy'])->name('staff.grade.destroy');
        // Grade Remarks Routes
        Route::get('/grade-remarks', [StaffController::class, 'gradeRemarks'])->name('staff.grade.remarks');
        Route::post('/grade-remarks', [GradeRemarkController::class, 'store'])->name('staff.grade.remarks.store');
        Route::post('/grade-remarks/update', [GradeRemarkController::class, 'update'])->name('staff.grade.remarks.update');
        Route::get('/grade-remarks/delete/{id}', [GradeRemarkController::class, 'destroy'])->name('staff.grade.remarks.destroy');
        // General Remarks Route
        Route::get('/remarks', [StaffController::class, 'remarks'])->name('staff.remarks');
        Route::post('/remarks', [RemarkController::class, 'store'])->name('staff.remark.store');
        Route::post('/remarks/update', [RemarkController::class, 'update'])->name('staff.remark.update');
        Route::get('/remarks/delete/{id}', [RemarkController::class, 'destroy'])->name('staff.remark.destroy');
        //Student Routes
        Route::get('/students/add', [StaffController::class, 'addStudents'])->name('staff.student.add');
        Route::get('/students/view', [StaffController::class, 'viewStudents'])->name('staff.students.view');
        Route::post('/students/add', [StudentController::class, 'store'])->name('staff.student.store');
        Route::post('/students/update', [StudentController::class, 'update'])->name('staff.student.update');
        //Other Routes
        Route::get('/class-subjects', [StaffController::class, 'classSubjects'])->name('staff.class_subjects');
        Route::post('/class-subjects', [ClassSubjectController::class, 'store'])->name('staff.class_subjects.store');
        Route::post('/class-subjects/remove', [ClassSubjectController::class, 'destroy'])->name('staff.class_subjects.destroy');
        //Result routes
        Route::get('/result/upload', [StaffController::class, 'resultUpload'])->name('staff.result.upload');
        Route::post('/result/upload', [ResultController::class, 'store'])->name('staff.result.store');
        Route::get('/result/print', [StaffController::class, 'printResult'])->name('staff.result.print');
        Route::post('/result/print', [ResultController::class, 'print'])->name('result.print');
        //Config Routes
        Route::get('/configurations', [StaffController::class, 'configurations'])->name('staff.configurations');
        Route::post('/configurations', [Controller::class, 'saveConfig'])->name('staff.save_configurations');
        //staff ROutes
        Route::get('/staff/add', [StaffController::class, 'addStaff'])->name('staff.staff.add');
        Route::post('/staff/add', [StaffController::class, 'storeStaff'])->name('staff.staff.store');
        Route::post('/staff/update', [StaffController::class, 'updateStaff'])->name('staff.staff.update');
        //logout
        Route::get('/logout', [StaffController::class, 'logout'])->name('staff.logout');
    });
});

Route::get('/forgot', function () {
    return view('auth.forgot');
});
