<?php

namespace common\widgets\ArtMinToggleSwitch;

use yii\base\InvalidConfigException;
use yii\base\InvalidArgumentException;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\InputWidget;

class ArtMinToggleSwitchWidget extends InputWidget
{

    const CHECKBOX = "checkbox";

    /*
     * Это поле означает тип input ,который будет использован. В данной версии
     * используется только checkbox, однако в будущем может прибавиться еще и radio
     */
    public $type;

    /*
     * Этот класс назначается input checkbox для того, чтобы можно было
     * с ним работать через javascript
     */
    public $class = 'm_switch_check';

    /*
     * Если переключатель включен
     */
    public $turnOnValue = 1;


    /*
     * Если переключатель выключен
     */
    public $turnOffValue = 0;

    /*
     * Просто массив возможных типов полей для проверки поддержки в виджете
     */
    public $typesList = [
        self::CHECKBOX,
//        self::RADIO
    ];

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();

        if ($this->type == null) {
            $this->type = self::CHECKBOX;

        }

        if (empty($this->type) || !in_array($this->type, $this->typesList)) {
            throw new InvalidConfigException("Type not set. Type must be either checkbox or radio.");
        }
    }

    /**
     * @return string|void
     */
    public function run()
    {
        parent::run();

        if($this->type === self::CHECKBOX){
            $input = $this->getCheckbox($this->type);//строим input
        }

        $this->registerAssets();//превращаем input checkbox в красивый переключатель

        echo $input;//выводим переключатель
    }

    //Этот метод можно было бы не создавать, но тогда
    //метод run() был бы менее читаем
    protected function getCheckbox($type)
    {

        if (empty($this->options['label'])) {
            $this->options['label'] = null;
        }

        $options = \yii\helpers\ArrayHelper::merge(
            $this->options, ['class' => $this->class]
        );

        if ($this->hasModel()) {
            $input = 'active' . ucfirst($type);
            return Html::$input($this->model, $this->attribute, $options);

        } else {
            if ($type == self::CHECKBOX) {
                $input = $type;
                $checked = false;
                return Html::$input($this->name, $checked, $options);
            } else {
                throw new InvalidArgumentException("Field type not supported");
            }

        }
    }

    /**
     * Register assets.
     */
    protected function registerAssets()
    {
        /*
         * Регистрируем стили и скрипты плагина
         */
        $view = $this->getView();
        ArtMinToggleSwitchAsset::register($view);

        /*
         * Регистрируем скрипт, который применится к чекбоксу и видоизменит его
         * в красивый switch. Также меняем value input checkbox при событиях
         * переключения свича. Скрипт отработает, когда html документ будет построен
         *
         */
        $js = <<<JS
        
        $(".{$this->class}").mSwitch({
            onRendered: function(){},
            onRender: function(elem){},
            onTurnOn: function(elem){
                elem.val({$this->turnOnValue});
            },
            onTurnOff: function(elem){
                elem.val({$this->turnOffValue});
            }
        });
JS;

        $view->registerJs($js, \yii\web\View::POS_READY);

    }

}