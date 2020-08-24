<?php


namespace common\components;

use common\models\Pages;
use yii\base\InvalidArgumentException;
use Yii;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;

/**
 * Class Helper
 * @package app\components
 */
class Helper
{

    /**
     * Check decimal
     *
     * @param $val
     * @return bool
     */
    public static function is_decimal( $val )
    {
        return is_numeric( $val ) && floor( $val ) != $val;
    }

    /**
     * Decimal format
     *
     * @param $value
     * @return string
     */
    public static function decimal($value)
    {
        return number_format((float)$value, 2, '.', '');
    }

    /**
     * Generate leading IDs
     *
     * @param $value
     * @param null $hasString
     * @param int $length
     * @return bool|string
     */
    public static function leadingId($value, $hasString = null, $length = 5)
    {
        if (!is_null($value)) {
            $leadingId = sprintf('%0'.$length.'d', $value);
            $leadingIdWithString = $hasString.'-'.$leadingId;

            return !is_null($hasString)? $leadingIdWithString : $leadingId;
        }

        return false;
    }

    /**
     * Get child nodes by id
     *
     * @param $parent
     * @param int $level
     */
    public function getChildren($parent, $level = 0) {
        $model = Pages::find()->where(['parent_id' => $parent])->all();
        foreach ($model as $key) {
            $alias = $key->alias == '#' ? '' : $key->alias;
            echo '<ol class="artmin-menu-list">';
            echo '<li class="artmin-menu-item">
                                    <div class="artmin-menu-item-content">
                                        <div class="artmin-menu-item-handle d-flex flex-wrap">

                                            <div class="artmin-menu-item-data d-flex">
                                                <div class="artmin-menu-item-title">'.$key->name.'</div>
                                                <div class="artmin-menu-item-alias">'.$alias.'</div>
                                            </div>
                                            
                                            <div class="artmin-menu-item-buttons d-flex align-content-center justify-content-end">
                                                <a href="'.Url::to(['pages/view/'.$key->id]).'" class="artmin-menu-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="18" viewBox="0 0 22 16" aria-labelledby="view" role="presentation" class="fill-current"><path d="M16.56 13.66a8 8 0 0 1-11.32 0L.3 8.7a1 1 0 0 1 0-1.42l4.95-4.95a8 8 0 0 1 11.32 0l4.95 4.95a1 1 0 0 1 0 1.42l-4.95 4.95-.01.01zm-9.9-1.42a6 6 0 0 0 8.48 0L19.38 8l-4.24-4.24a6 6 0 0 0-8.48 0L2.4 8l4.25 4.24h.01zM10.9 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path></svg>
                                                </a>
                                                <a href="'.Url::to(['pages/update/'.$key->id]).'" class="artmin-menu-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="fill-current "><path d="M4.3 10.3l10-10a1 1 0 0 1 1.4 0l4 4a1 1 0 0 1 0 1.4l-10 10a1 1 0 0 1-.7.3H5a1 1 0 0 1-1-1v-4a1 1 0 0 1 .3-.7zM6 14h2.59l9-9L15 2.41l-9 9V14zm10-2a1 1 0 0 1 2 0v6a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h6a1 1 0 1 1 0 2H2v14h14v-6z"></path></svg>
                                                </a>
                                                <a href="'.Url::to(['pages/delete/'.$key->id]).'" data-method="post" data-confirm="Yes?" class="artmin-menu-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="fill-current "><path d="M6 4V2a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6H1a1 1 0 1 1 0-2h5zM4 6v12h12V6H4zm8-2V2H8v2h4zM8 8a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1z"></path></svg>
                                                </a>
                                            </div>
                                            </div>
                                            </div>
                                            </li>';
            $this->getChildren($key->id, $level+1);
            echo '</ol>';
        }
    }

    /**
     * Main menu
     *
     * @throws \Exception
     */
    public static function constructMenu()
    {
        // Generate dropdown by existing languages
        $languageDropdown = [];

        foreach (Yii::$app->params['languages'] as $language) {
            $languageDropdown[] = ['label' => ucfirst($language), 'url' => Url::to($language)];
        }

        NavBar::begin([ // отрываем виджет
            'brandLabel' => false, // название организации
            'brandUrl' => \Yii::$app->homeUrl, // ссылка на главную страницу сайта
            'options' => [
                'class' => 'main-header navbar navbar-expand bg-white navbar-light border-bottom', // стили главной панели
            ],
            'renderInnerContainer' => false,
        ]);

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav w-100'], // стили ul
            'items' => [
                ['label' => Yii::t('app', 'Склад'), 'url' => ['/warehouse/index']],
                ['label' => Yii::t('app', 'Помещение'), 'url' => ['/premise/index']],
                ['label' => Yii::t('app', 'Секция'), 'url' => ['/unit/index']],
                ['label' => Yii::t('app', 'Линия'), 'url' => ['/line/index']],
                ['label' => Yii::t('app', 'Стеллаж'), 'url' => ['/rack/index']],
                ['label' => Yii::t('app', 'Ярус'), 'url' => ['/storey/index']],
                ['label' => Yii::t('app', 'Ячейка'), 'url' => ['/cell/index']],
                ['label' => Yii::t('app', 'Номенклатура'), 'url' => ['/nomenclature/index']],
                ['label' => Yii::t('app', 'Документооборот'), 'url' => ['/documents/index']],
                [
                    'label' => ucfirst(Yii::$app->language),
                    'items' => $languageDropdown,
                    'options' => ['class' => 'ml-auto']
                ],
                \Yii::$app->user->isGuest ? // Если пользователь гость, показыаем ссылку "Вход", если он авторизовался "Выход"
                    [
                        'label' => 'Вход',
                        'url' => ['/site/login'],
                    ] :
                    [
                        'label' => Yii::t('app', 'Выход') . ' (' . \Yii::$app->user->identity->username . ')',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post']
                    ],
            ],
        ]);

        NavBar::end(); // закрываем виджет
    }

    /**
     * Get real ip
     *
     * @return mixed|string
     */
    public static function RealIP() {
        $ip = false;

        $seq = array('HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR'
        , 'HTTP_X_FORWARDED'
        , 'HTTP_X_CLUSTER_CLIENT_IP'
        , 'HTTP_FORWARDED_FOR'
        , 'HTTP_FORWARDED'
        , 'REMOTE_ADDR');

        foreach ($seq as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
                        return $ip;
                    }
                }
            }
        }
    }

    /**
     * Convert multidimensional array to string
     *
     * @param $glue
     * @param $arr
     * @return string
     */
    public static function convertMultiArray($glue, $arr){
        for ($i=0; $i<count($arr); $i++) {
            if (@is_array($arr[$i]))
                $arr[$i] = self::convertMultiArray($glue, $arr[$i]);
        }
        return implode($glue, $arr);
    }

}