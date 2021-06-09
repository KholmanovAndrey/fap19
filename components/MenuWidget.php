<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 07.05.2016
 * Time: 10:35
 */

namespace app\components;
use yii\base\Widget;
use app\models\Menu;
use Yii;

class MenuWidget extends Widget{

    public $tpl;
    public $data;
    public $tree;
    public $menuHtml;

    public function init(){
        parent::init();
        if( $this->tpl === null ){
            $this->tpl = 'li';
        }
        $this->tpl .= '.php';
    }

    public function run(){
        // получение данных из кеша
        $menu = Yii::$app->cache->get('menu');
        //if($menu) return $menu;
        
        $this->data = Menu::find()->where(['publication' => 1])->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);
        
        // запись в кеш
        Yii::$app->cache->set('menu', $this->menuHtml, 60*60);
        
        return $this->menuHtml;
    }

    protected function getTree(){
        $tree = [];
        foreach ($this->data as $id=>&$node) {
            if (!$node['parent_id'])
                $tree[$id] = &$node;
            else
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
        }
        return $tree;
    }

    protected function getMenuHtml($tree){
        $str = '';
        foreach ($tree as $menu) {
            $str .= $this->catToTemplate($menu);
        }
        return $str;
    }

    protected function catToTemplate($menu){
        ob_start();
        include __DIR__ . '/menu_tpl/' . $this->tpl;
        return ob_get_clean();
    }

} 