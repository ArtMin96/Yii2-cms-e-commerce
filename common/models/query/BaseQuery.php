<?php

namespace common\models\query;


use common\models\Pages;
use yii\db\Query;

class BaseQuery extends \yii\base\Model
{

    /**
     * Recursively get child nodes
     *
     * @param array $model
     * @param null $parentID
     * @return array
     */
    public static function recCategoryChild($model, $parentID = null) {

        $categories = [];
        foreach ($model as $category) {
            if ($category['parent_id'] == $parentID) {
                $child = self::recCategoryChild($model, $category['id']);
                if ($child) {
                    $category['child'] = $child;
                }
                $categories[] = $category;
            }
        }

        return $categories;
    }

}