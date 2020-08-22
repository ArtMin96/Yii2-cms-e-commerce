<?php


namespace common\components;

use Yii;
use yii\base\InvalidConfigException;
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
     * Draw categories tree
     *
     * @param array $array
     * @param int $level
     */
    public static function drawCategoryTree(array $array, $level = 0)
    {
        if (!empty($array)) {
            foreach ($array as $node) {
                if (isset($node['child'])) {
                    echo '<li data-category="'.$node["id"].'" class="base-tree"><span class="caret"><a href="'.$node['id'].'">'.$node['name'].'</a></span>';
                } else {
                    echo '<li data-category="'.$node["id"].'" class="base-tree"><a href="'.$node['id'].'">'.$node['name'].'</a>';
                }

                if (isset($node['child']) && !empty($node['child'])) {
                    echo '<ul class="nested">';
                    self::drawCategoryTree($node['child'], $level + 1);
                    echo '</ul>';
                }
                echo '</li>';
            }
        } else {
            throw new InvalidConfigException('Category cannot be empty.');
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

}