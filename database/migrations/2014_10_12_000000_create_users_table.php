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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('phone',11)->comment('登录手机号');
            $table->string('password');
            $table->string('nickname')->comment('昵称');
            $table->string('avatar',256)->nullable()->comment('头像');

            // 微信相关字段
            $table->string('unionId',30)->nullable()->comment('当用户将公众号绑定到微信开放平台账号后，才会出现该字段');
            $table->string('openId',30) ->nullable()->comment('用户的标识，对当前的公众号唯一');
            $table->string('mnpOpenId',32)->nullable()->comment('小程序的唯一身份ID');


            // 上次登录时间和IP
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->unique('phone');
            $table->index('unionId');
            $table->index('openId');
            $table->index('mnpOpenId');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
