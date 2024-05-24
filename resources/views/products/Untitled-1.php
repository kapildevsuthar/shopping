<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTaxColumnsInProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Change cgst and sgst columns from integer to float
            $table->float('cgst', 8, 2)->change();
            $table->float('sgst', 8, 2)->change();
            
            // Add the igst column as a float
            $table->float('igst', 8, 2)->nullable()->after('sgst');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Revert the cgst and sgst columns back to integer
            $table->integer('cgst')->change();
            $table->integer('sgst')->change();
            
            // Drop the igst column
            $table->dropColumn('igst');
        });
    }
}