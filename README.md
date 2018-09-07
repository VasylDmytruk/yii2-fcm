Yii2 wrap on [autoxloo/fcm](https://github.com/VasylDmytruk/fcm)
=========================
Yii2 wrap on autoxloo/fcm

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist test/yii2-fcm "*"
```

or

```
composer require --prefer-dist test/yii2-fcm "*"
```

or add

```
"test/yii2-fcm": "*"
```

to the require section of your `composer.json` file.

Config
------

In your application config add:

```
// ...
'components' => [
        // ...
        'firebaseNotification' => [
            'class' => \autoxloo\yii2\fcm\FirebaseCMNotification::class,
            'projectId' => 'project-id',
            'serviceAccountFile' => __DIR__ . '/service_account.json',
        ],
],
```

Usage
-----

Once the extension is installed, simply use it in your code by :

```php
$token = 'device token';
$name = 'Some name';
$title = 'Some title';
$body = 'Some body';
$data = [
    'some key1' => 'some value1',
    'some key2' => 'some value2',
];

$response = $fcmNotification->send([
    'message' => [
        'token' => $token,
        'notification' => [
            'title' => $title,
            'body' => $body,
        ],
        'data' => (array)$data,
        'android' => [
            'priority' => 'HIGH',
        ],
    ]
]);
```

See [autoxloo/fcm](https://github.com/VasylDmytruk/fcm) for more details.