<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueConstraintToCartHold extends Migration
{
    public function up()
    {
        Schema::table('cart_holds', function (Blueprint $table) {
            $table->unique(['user_id', 'session_id', 'book_id'], 'cart_hold_unique');
        });
    }

    public function down()
    {
        Schema::table('cart_holds', function (Blueprint $table) {
            $table->dropUnique('cart_hold_unique');
        });
    }
}
