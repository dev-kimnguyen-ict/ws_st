<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasicDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('avatar')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->date('birthday')->nullable();
            $table->tinyInteger('gender')->default(User::MALE);
            $table->boolean('active')->default(true);
            $table->boolean('blocked')->default(false);
            $table->tinyInteger('role_id')->default(User::USER);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });

        Schema::create('socials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('email')->nullable();
            $table->string('avatar_url')->nullable();
            $table->string('user_provider_id');
            $table->string('provider');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('seos', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('seoable');
            $table->string('title', 100);
            $table->string('description', 250)->nullable();
            $table->string('keywords')->nullable();
            $table->string('robots')->nullable();
            $table->string('revisit_after')->nullable();
            $table->string('alias');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description', 300)->nullable();
            $table->integer('parent_id')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('thumbnail')->nullable();
            $table->double('price')->default(0);
            $table->integer('discount')->default(0);
            $table->string('description', 300);
            $table->text('content')->nullable();
            $table->integer('view')->default(0);
            $table->tinyInteger('mark')->default(0);
            $table->integer('category_id')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->unique();
            $table->integer('owner_id')->nullable();
            $table->string('name');
            $table->string('extension');
            $table->string('size');
            $table->string('path');
            $table->string('mime')->nullable();
            $table->morphs('uploadable');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer');
            $table->string('address');
            $table->string('phone');
            $table->text('note');
            $table->integer('product_count')->default(0);
            $table->double('amount')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->string('payment')->nullable();
            $table->string('payment_info')->nullable();
            $table->integer('user_id')->nullable();
            $table->timestamp('delivery_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('product_id');
            $table->string('name');
            $table->double('price')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('quantity')->default(0);
            $table->double('amount')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('socials');
        Schema::dropIfExists('seos');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('products');
        Schema::dropIfExists('uploads');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_details');
    }
}
