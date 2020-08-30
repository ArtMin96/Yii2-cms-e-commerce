<?php

return [
//    '<action:.*>' => 'site/<action>'
    '/pages/items/<id:\d+>' => '/pages/items',
    '/pages/view/<id:\d+>' => '/pages/view',
    '/pages/update/<id:\d+>' => '/pages/update',
    '/pages/delete/<id:\d+>' => '/pages/delete',
];