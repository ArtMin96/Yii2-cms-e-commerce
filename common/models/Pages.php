<?php

namespace common\models;

use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "pages".
 *
 * @property int $id
 * @property string $name
 * @property string $alias
 * @property string $type
 * @property int|null $parent_id
 * @property int|null $order_sort
 * @property int|null $deleted
 * @property int|null $allow_delete
 * @property int|null $allow_parent
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Pages $parent
 * @property Pages[] $pages
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'alias'], 'required'],
            [['parent_id', 'order_sort', 'deleted', 'allow_delete', 'allow_parent'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'alias', 'type'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pages::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'name' => Yii::t('backend', 'Name'),
            'alias' => Yii::t('backend', 'Alias'),
            'type' => Yii::t('backend', 'Type'),
            'parent_id' => Yii::t('backend', 'Parent'),
            'order_sort' => Yii::t('backend', 'Order Sort'),
            'deleted' => Yii::t('backend', 'Deleted'),
            'allow_delete' => Yii::t('backend', 'Allow Delete'),
            'allow_parent' => Yii::t('backend', 'Allow Parent'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
        ];
    }

    /**
     * @return array|array[]
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes'=>[
                    self::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    self::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
                'value' => new Expression('NOW()'),
            ],
            'ml' => [
                'class' => MultilingualBehavior::className(),
                'languages' => Yii::$app->params['languages'],
                'requireTranslations' => 'true',
                'defaultLanguage' => 'en',
                'langForeignKey' => 'parent_id',
                'tableName' => "{{%pages_lang}}",
                'attributes' => [
                    'name'
                ]
            ],
        ];
    }

    /**
     * @return MultilingualQuery|\yii\db\ActiveQuery
     */
    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Pages::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[Pages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChild()
    {
        return $this->hasMany(Pages::className(), ['parent_id' => 'id']);
    }

    /**
     * Gets root rows
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getRoot()
    {
        return self::find()->where(['parent_id' => null, 'deleted' => 0])->orderBy(['order_sort' => SORT_ASC])->asArray()->all();
    }

    /**
     * Get child node ids
     *
     * @param $parent
     * @return array
     */
    public static function getChildrenString($parent) {
        $model = Pages::find()->where(['parent_id' => $parent])->all();
        $storage = [];
        foreach ($model as $key) {
            $storage[] = $key->id;
            $storage[] = self::getChildrenString($key->id);
        }
        return $storage;
    }

    /**
     * Skip selected node child items
     *
     * @param $id
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function skipSelectedNodeChilds($id)
    {
        return self::find()->where(['NOT IN', 'id', $id])->all();
    }
}
