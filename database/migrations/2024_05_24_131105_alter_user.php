<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    //responsiblefortraining مسئول اموزش
    //Head of the faculty مسئول دانشکده
    //sample userمسئول دانشکده
    //admin userمسئول دانشکده
    /*اربر admin:
همه چیز رو به تفکیک دانشکده ببینه
کاربر سطح یک : مسیول آموزش
همه ی گزینه هارو به تفکیک دانشکده ببینه
یعنی دروس کلاس برنامه گزارش گیری و... برای هر دانشکده رو بتونه جدا ببینه + قابلیت اعمال تغیرات کلی مثل بخش ورودی و زمان بندی و ایجاد ترم جدید برای تمام دانشکده ها
 به جز بخش کاربر ها
 */

    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
