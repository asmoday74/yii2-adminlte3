<?php


namespace asmoday74\adminlte3;

use Yii;
use yii\helpers\Json;


class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'asmoday74\adminlte3\controllers';
    /**
     * {@inheritdoc}
     */
    public $defaultRoute = "adminlte";

    /**
     * @var string, the name of module
     */
    public $name = "YII2 AdminLTE 3";

    /**
     * @var string, the description of module
     */
    public $description = "AdminLTE Bootstrap Admin Dashboard Template";

    public function init()
    {
        parent::init();

        $this->registerTranslations();
    }

    /**
     * Registers translations for module
     */
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['asmoday74/adminlte'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@vendor/asmoday74/yii2-adminlte3/src/messages',
            'fileMap' => [
                'asmoday74/adminlte' => 'adminlte.php',
            ],
        ];
    }

    /**
     * Public translation function, Module::t('asmoday74/adminlte', 'Hello');
     * @return string of current message translation
     */
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('asmoday74/' . $category, $message, $params, $language);
    }

    protected function defaultVersion()
    {
        $packageInfo = Json::decode(file_get_contents(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'composer.json'));
        $extensionName = $packageInfo['name'];
        if (isset(Yii::$app->extensions[$extensionName])) {
            return Yii::$app->extensions[$extensionName]['version'];
        }
        return parent::defaultVersion();
    }
}