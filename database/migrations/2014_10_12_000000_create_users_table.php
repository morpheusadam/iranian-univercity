<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
        //responsiblefortraining مسئول اموزش
    //Head of the faculty مسئول دانشکده
 
    /*اربر admin:
همه چیز رو به تفکیک دانشکده ببینه
کاربر سطح یک : مسیول آموزش
همه ی گزینه هارو به تفکیک دانشکده ببینه
یعنی دروس کلاس برنامه گزارش گیری و... برای هر دانشکده رو بتونه جدا ببینه + قابلیت اعمال تغیرات کلی مثل بخش ورودی و زمان بندی و ایجاد ترم جدید برای تمام دانشکده ها
 به جز بخش کاربر ها
 */

    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('collage_name')->nullable();
            $table->enum('role', ['admin', 'educational_supervisor', 'faculty_head', 'professor']);

        });
        DB::table('users')->insert([
            'name' => 'admin',
            'username' => 'admin',
            'password' => Hash::make('12345678'),
            'collage_name' => 'admin',
            'role' => 'admin'
        ]);
        DB::table('users')->insert([
            'name' => 'educational_supervisor',
            'username' => 'educational_supervisor',
            'password' => Hash::make('12345678'),
            'collage_name' => 'educational_supervisor',
            'role' => 'educational_supervisor'
        ]);
        DB::table('users')->insert([
            'name' => 'faculty_head',
            'username' => 'faculty_head',
            'password' => Hash::make('12345678'),
            'collage_name' => 'faculty_head',
            'role' => 'faculty_head'
        ]);
         DB::table('users')->insert([
            'name' => 'professor',
            'username' => 'professor',
            'password' => Hash::make('12345678'),
            'collage_name' => 'professor',
            'role' => 'professor'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
