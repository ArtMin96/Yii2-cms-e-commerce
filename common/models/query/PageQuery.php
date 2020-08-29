<?php


namespace common\models\query;


use omgdef\multilingual\MultilingualTrait;
use yii\db\ActiveQuery;

class PageQuery extends ActiveQuery
{

    use MultilingualTrait;

    /**
     * @return mixed
     */
    public function isLink()
    {
        return $this->andWhere(['type' => '_link']);
    }

    /**
     * @return mixed
     */
    public function isText()
    {
        return $this->andWhere(['type' => '_text']);
    }

    /**
     * @return mixed
     */
    public function isRoot()
    {
        return $this->andWhere(['parent_id' => null]);
    }

    /**
     * @return mixed
     */
    public function isParentAllowed()
    {
        return $this->andWhere(['allow_parent' => 1]);
    }

    /**
     * @return mixed
     */
    public function isParentNotAllowed()
    {
        return $this->andWhere(['allow_parent' => 0]);
    }

    /**
     * @return mixed
     */
    public function isDeleteAllowed()
    {
        return $this->andWhere(['allow_delete' => 1]);
    }

    /**
     * @return mixed
     */
    public function isDeleteNotAllowed()
    {
        return $this->andWhere(['allow_delete' => 0]);
    }

    /**
     * @return mixed
     */
    public function isDeleted()
    {
        return $this->andWhere(['deleted' => 1]);
    }

    /**
     * @return mixed
     */
    public function isNotDeleted()
    {
        return $this->andWhere(['deleted' => 0]);
    }

}