<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

Yii::setAlias('@uploadBannerImage', dirname(dirname(__DIR__)) . '/frontend/web/uploads/banner');
Yii::setAlias('@uploadUserImage', dirname(dirname(__DIR__)) . '/frontend/web/uploads/users');
Yii::setAlias('@uploadProductImage', dirname(dirname(__DIR__)) . '/frontend/web/uploads/products');
Yii::setAlias('@uploadCV', dirname(dirname(__DIR__)) . '/frontend/web/uploads/cv');
