<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Bank;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('shaba',26)->unique();
            $table->string('number',16)->unique();
            $table->bigInteger('credit')->unsigned()->default(0);
            $table->string('password',6);
            $table->foreignIdFor(Human::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Bank::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};
