<?php

namespace autoxloo\yii2\fcm;

use autoxloo\fcm\FirebaseCloudMessaging;
use yii\base\Component;
use yii\base\InvalidConfigException;

/**
 * Class FirebaseCMNotification Yii2 wrap on [[\autoxloo\fcm\FirebaseCloudMessaging]].
 * @see FirebaseCloudMessaging
 */
class FirebaseCMNotification extends Component
{
    /**
     * @var string Project ID of the Firebase project for your app.
     * This ID is available in the General project settings tab of the Firebase console.
     * @see https://console.firebase.google.com/project/_/settings/general/
     */
    public $projectId;
    /**
     * @var string Path to generated private key file in JSON format.
     * @see https://console.firebase.google.com/project/_/settings/serviceaccounts/adminsdk
     */
    public $serviceAccountFile;

    /**
     * @var FirebaseCloudMessaging
     */
    protected $fcm;


    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();

        if (empty($this->projectId)) {
            throw new InvalidConfigException('Param "projectId" is required');
        }

        if (!file_exists($this->serviceAccountFile)) {
            throw new InvalidConfigException(
                "Param 'serviceAccountFile' ({$this->serviceAccountFile}) should be valid path to service account file"
            );
        }

        $this->fcm = new FirebaseCloudMessaging($this->projectId, $this->serviceAccountFile);
    }

    /**
     * Sends push notification.
     *
     * @param array $message Request body to send push notification.
     *
     * @return \GuzzleHttp\Psr7\Response
     */
    public function send($message)
    {
        return $this->fcm->send($message);
    }
}