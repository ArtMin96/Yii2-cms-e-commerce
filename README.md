<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>

Yii 2 Advanced Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Build Status](https://travis-ci.com/yiisoft/yii2-app-advanced.svg?branch=master)](https://travis-ci.com/yiisoft/yii2-app-advanced)

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```

Packages used:
##### [Yii2 Collection](https://github.com/yii2mod/collection)
##### [Yii2 Image Extension](https://github.com/yii2mod/yii2-image)
##### [Yii2 LocaleUrls](https://github.com/codemix/yii2-localeurls/)
##### [Yii2 multilingual behavior](https://github.com/OmgDef/yii2-multilingual-behavior)
##### [Yii2 jquery sortable](https://github.com/demogorgorn/yii2-jquery-sortable)
##### [Kartik ActiveForm](https://github.com/kartik-v/yii2-widget-activeform)
##### [Kartik Select2](https://github.com/kartik-v/yii2-widget-select2)
##### [Kartik DepDrop](https://github.com/kartik-v/yii2-widget-depdrop)
##### [Kartik Bootstrap File Input](https://github.com/kartik-v/bootstrap-fileinput)
##### [Kartik File Input Widget](https://github.com/kartik-v/yii2-widget-fileinput)
##### [Yii2 Slugify](https://www.yiiframework.com/extension/yii2-slugify)
##### [Yii2 Tags Input](https://github.com/mludvik/yii2-tags-input)
