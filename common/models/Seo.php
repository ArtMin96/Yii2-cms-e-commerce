<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "seo".
 *
 * @property int $id
 * @property int|null $page_id
 * @property string|null $meta_title
 * @property string|null $meta_keywords
 * @property string|null $meta_description
 * @property string|null $meta_image
 * @property string|null $og_title
 * @property string|null $og_type
 * @property string|null $og_url
 * @property string|null $og_image
 * @property string|null $og_description
 * @property string|null $og_site_name
 * @property string|null $fb_admins
 * @property string|null $twitter_card
 * @property string|null $twitter_site
 * @property string|null $twitter_title
 * @property string|null $twitter_description
 * @property string|null $twitter_creator
 * @property string|null $twitter_image
 *
 * @property Pages $page
 */
class Seo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['page_id'], 'integer'],
            [['meta_keywords'], 'safe'],
            [['meta_description', 'og_description', 'twitter_description'], 'string'],
            [['meta_title', 'og_title', 'og_type', 'og_url', 'og_image', 'og_site_name', 'fb_admins', 'twitter_card', 'twitter_site', 'twitter_title', 'twitter_creator', 'twitter_image'], 'string', 'max' => 255],
            [['meta_image'], 'file', 'skipOnEmpty' => true, 'extensions' => ['jpg', 'jpeg', 'png']],
            [['page_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pages::className(), 'targetAttribute' => ['page_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_id' => 'Page ID',
            'meta_title' => 'Meta Title',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'meta_image' => 'Meta Image',
            'og_title' => 'Og Title',
            'og_type' => 'Og Type',
            'og_url' => 'Og Url',
            'og_image' => 'Og Image',
            'og_description' => 'Og Description',
            'og_site_name' => 'Og Site Name',
            'fb_admins' => 'Fb Admins',
            'twitter_card' => 'Twitter Card',
            'twitter_site' => 'Twitter Site',
            'twitter_title' => 'Twitter Title',
            'twitter_description' => 'Twitter Description',
            'twitter_creator' => 'Twitter Creator',
            'twitter_image' => 'Twitter Image',
        ];
    }

    /**
     * Gets query for [[Page]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Pages::className(), ['id' => 'page_id']);
    }

    public function save($runValidation = true, $attributeNames = null)
    {

        $path = Yii::getAlias('@frontend/web/storage/seo/'.$this->page_id.'/');

        if (!empty($this->meta_image)) {
            $fileName = Yii::$app->security->generateRandomString(12).'.'.$this->meta_image->extension;
            $MetaImagePath = $path.$fileName;

            if (!is_dir($path)) {
                FileHelper::createDirectory($path, 0777);
            }

            $this->meta_image->saveAs($MetaImagePath);
            $this->meta_image = $fileName;
        }

        if (!empty($this->og_image)) {
            $ogFileName = Yii::$app->security->generateRandomString(12).'.'.$this->og_image->extension;
            $OgImagePath = $path.$ogFileName;

            if (!is_dir($path)) {
                FileHelper::createDirectory($path, 0777);
            }

            $this->og_image->saveAs($OgImagePath);
            $this->og_image = $ogFileName;
        }

        if (!empty($this->twitter_image)) {
            $twitterFileName = Yii::$app->security->generateRandomString(12).'.'.$this->twitter_image->extension;
            $TwitteerImagePath = $path.$twitterFileName;

            if (!is_dir($path)) {
                FileHelper::createDirectory($path, 0777);
            }

            $this->twitter_image->saveAs($TwitteerImagePath);
            $this->twitter_image = $twitterFileName;
        }

        $saved = parent::save($runValidation, $attributeNames);

        if (!$saved) {
            return false;
        }

        return true;
    }
}
