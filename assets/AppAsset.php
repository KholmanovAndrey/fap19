<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
    ];
    public $js = [
        'js/cart.js',
        'js/events.js',
        'js/search.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];

    public function init()
    {
        if (Yii::$app->request->url === '/cart/accept' ||
            Yii::$app->request->url === '/cart/history') {
            $this->js[] = 'js/order.js';
        }
        if (Yii::$app->request->url === '/cart/order') {
            $this->js[] = 'js/delivery_payment.js';
        }
    }
}
