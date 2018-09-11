Yii2 wrap of [autoxloo/fcm](https://github.com/VasylDmytruk/fcm)
=========================
Yii2 wrap of autoxloo/fcm

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist autoxloo/yii2-fcm "*"
```

or

```
composer require --prefer-dist autoxloo/yii2-fcm "*"
```

or add

```
"autoxloo/yii2-fcm": "*"
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

Once the extension is installed, simply use it in your code by:

```php
$token = 'some device token';
$name = 'Some name';
$title = 'Some title';
$body = 'Some body';
$data = [
    'some key1' => 'some value1',
    'some key2' => 'some value2',
]; 

// sending push notification:

$target = FCMFacade::createTargetToken($token);     // only target is required
$notification = FCMFacade::createNotification($title, $body);
$androidConfig = FCMFacade::createAndroidConfig([AndroidConfig::FIELD_PRIORITY => AndroidConfig::PRIORITY_HIGH]);

$message = FCMFacade::createMessage();
$message->setTarget($target)
    ->setName($name)
    ->setData($data)
    ->setNotification($notification)
    ->setAndroidConfig($androidConfig);

$response = Yii::$app->firebaseNotification->send($message);   // $response is instance of \GuzzleHttp\Psr7\Response
```

Or

```php
$messageConfig = [
    // required one of: token, topic or condition
    Message::FIELD_TOKEN => $token,     // or Message::FIELD_TOPIC => $topic or Message::FIELD_CONDITION => $condition

    // not required values:
    Message::FIELD_NAME => $name,
    Message::FIELD_DATA => $data,
    Message::FIELD_NOTIFICATION => FCMFacade::createNotification($title, $body),
    Message::FIELD_ANDROID => FCMFacade::createAndroidConfig([
        AndroidConfig::FIELD_PRIORITY => AndroidConfig::PRIORITY_HIGH
    ]),
];

$message = FCMFacade::createMessage($messageConfig);

$response = Yii::$app->firebaseNotification->send($message);   // $response is instance of \GuzzleHttp\Psr7\Response
```

Target
------

You can use target one of:
- `TargetToken`
- `TargetTopic`
- `TargetCondition`

To create use facade:

```php
$targetToken = FCMFacade::createTargetToken('token');
$targetTopic = FCMFacade::createTargetToken('topic');
$targetCondition = FCMFacade::createTargetToken('condition');
```

See [autoxloo/fcm](https://github.com/VasylDmytruk/fcm) for more details.