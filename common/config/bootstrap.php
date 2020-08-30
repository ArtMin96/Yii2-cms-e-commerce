<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

Yii::setAlias('@uploadBannerImage', dirname(dirname(__DIR__)) . '/frontend/web/storage/banner');
Yii::setAlias('@uploadUserImage', dirname(dirname(__DIR__)) . '/frontend/web/storage/users');
Yii::setAlias('@uploadProductImage', dirname(dirname(__DIR__)) . '/frontend/web/storage/products');
Yii::setAlias('@uploadCV', dirname(dirname(__DIR__)) . '/frontend/web/storage/cv');
Yii::setAlias('@storage', 'http://gaud.loc/storage');
