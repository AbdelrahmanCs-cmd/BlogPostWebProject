<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('posts', 'blogs');

        Schema::table('blogs', function (Blueprint $table) {
            $table->string('image')->nullable()->after('status');

            $table->unsignedBigInteger('category_id')->nullable()->after("image");

            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
            $table->dropColumn('summary');
        });
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['image', 'category_id']);
            $table->text('summary');
        });

        Schema::rename('blogs', 'posts');
    }
};
