<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 07.05.2016
 * Time: 10:35
 */

namespace app\components;
use yii\base\Widget;
use app\models\Category;
use Yii;

class CategoryWidget extends Widget{

    public $tpl;
    public $data;
    public $tree;
    public $categoryHtml;
    public $categoryID;
    public $categoryCurrent;
    public $cache = true;

    public function init(){
        parent::init();
        if( $this->tpl === null ){
            $this->tpl = 'li';
        }
        $this->tpl .= '.php';
    }

    public function run(){
        // получение данных из кеша
        if ($this->cache) {
            $category = Yii::$app->cache->get('category');
            //if($category) return $category;
        }

        if(!$this->categoryID){
            $this->data = Category::find()
                ->where(['publication' => 1])
                ->indexBy('id')->asArray()->all();
            $this->tree = $this->getTree();
            $this->categoryHtml = $this->getCategoryHtml($this->tree);
        }
        else{
            $this->data = Category::find()
                ->where(['publication' => 1, 'parent_id' => $this->categoryID])
                ->indexBy('id')->asArray()->all();
            $this->categoryHtml = $this->getCategoryHtml($this->data);
        }
        
        // запись в кеш
        if ($this->cache) {
            Yii::$app->cache->set('category', $this->categoryHtml, 60*60);
        }

        return $this->categoryHtml;
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

    protected function getCategoryHtml($tree){
        $str = '';
        foreach ($tree as $category) {
            $str .= $this->catToTemplate($category, $this->categoryCurrent);
        }
        return $str;
    }

    protected function catToTemplate($category, $categoryCurrent){
        ob_start();
        include __DIR__ . '/category_tpl/' . $this->tpl;
        return ob_get_clean();
    }

} 