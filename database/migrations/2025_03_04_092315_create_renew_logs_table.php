<?php

use App\Enums\RenewType;
use App\Models\Organization;
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
        Schema::create('renew_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Organization::class, 'org_id')->constrained();
            $table->tinyInteger('type')->default(RenewType::Renew);
            $table->integer('renew_for')->default(0);
            $table->tinyInteger('renew_unit')->default(0);
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('renew_logs');
    }
};
