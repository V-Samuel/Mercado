<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('categorias', 'user_id')) {
            Schema::table('categorias', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            });
        }
        if (!Schema::hasColumn('produtos', 'user_id')) {
            Schema::table('produtos', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            });
        }

        // Assign existing records to Admin (id 1)
        \Illuminate\Support\Facades\DB::table('categorias')->update(['user_id' => 1]);
        \Illuminate\Support\Facades\DB::table('produtos')->update(['user_id' => 1]);
        \Illuminate\Support\Facades\DB::table('movimentacoes')->update(['usuario_id' => 1]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categorias', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
