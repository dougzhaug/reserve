<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatMpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_mps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agent_id')->comment('所属代理商');
            $table->string('nick_name')->comment('公众号名称');
            $table->string('qrcode_url')->comment('二维码图片的URL，开发者最好自行也进行保存');
            $table->string('user_name')->comment('授权方公众号的原始ID');
            $table->string('principal_name')->comment('公众号的主体名称');
            $table->string('alias')->default('')->comment('授权方公众号所设置的微信号，可能为空');
            $table->string('signature')->default('')->comment('授权方公众号所设置的微信号，可能为空');
            $table->string('business_info')->default('')->comment('用以了解以下功能的开通状况（0代表未开通，1代表已开通）： open_store:是否开通微信门店功能 open_scan:是否开通微信扫商品功能 open_pay:是否开通微信支付功能 open_card:是否开通微信卡券功能 open_shake:是否开通微信摇一摇功能');
            $table->tinyInteger('service_type_info')->comment('公众号类型 0代表订阅号，1代表由历史老帐号升级后的订阅号，2代表服务号');
            $table->tinyInteger('verify_type_info')->comment('授权方认证类型，-1代表未认证，0代表微信认证，1代表新浪微博认证，2代表腾讯微博认证，3代表已资质认证通过但还未通过名称认证，4代表已资质认证通过、还未通过名称认证，但通过了新浪微博认证，5代表已资质认证通过、还未通过名称认证，但通过了腾讯微博认证');
            $table->string('authorizer_appid')->comment('授权方appid');
            $table->string('authorizer_refresh_token')->comment('刷新token');
            $table->text('func_info')->comment('公众号授权给开发者的权限集列表，ID为1到15时分别代表： 1.消息管理权限 2.用户管理权限 3.帐号服务权限 4.网页服务权限 5.微信小店权限 6.微信多客服权限 7.群发与通知权限 8.微信卡券权限 9.微信扫一扫权限 10.微信连WIFI权限 11.素材管理权限 12.微信摇周边权限 13.微信门店权限 14.微信支付权限 15.自定义菜单权限 请注意： 1）该字段的返回不会考虑公众号是否具备该权限集的权限（因为可能部分具备），请根据公众号的帐号类型和认证情况，来判断公众号的接口权限。');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wechat_mps');
    }
}
