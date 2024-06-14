<?php
namespace asmoday74\adminlte3\widgets;

/**
 * Class ToastAlert
 * 
 * Alert widget renders a message from session flash. All flash messages are displayed
 * in the sequence they were assigned using setFlash. You can set message as following:
 *
 * ```php
 * Yii::$app->session->setFlash('error', 'This is the message');
 * Yii::$app->session->setFlash('success', 'This is the message');
 * Yii::$app->session->setFlash('info', 'This is the message');
 * ```
 *
 * Multiple messages could be set as follows:
 *
 * ```php
 * Yii::$app->session->setFlash('error', ['Error 1', 'Error 2']);
 * ```
 */
class ToastAlert extends Widget
{
    /**
     * @var array the alert types configuration for the flash messages.
     * This array is setup as $key => $value, where:
     * - key: the name of the session flash variable
     * - value: the bootstrap alert type (i.e. danger, success, info, warning)
     */
    public $alertTypes = [
        'error'   => 'bg-danger',
        'danger'  => 'bg-danger',
        'success' => 'bg-success',
        'info'    => 'bg-info',
        'warning' => 'bg-warning'
    ];
    /**
     * @var array the options for rendering the close button tag.
     * Array will be passed to [[\yii\bootstrap\Alert::closeButton]].
     */

    public function run()
    {
        $session = \Yii::$app->session;
        $flashes = $session->getAllFlashes();
        $this->registerPlugin('toast');

        //Toast container
        echo '<div class="toast-container position-absolute top-0 end-0 p-3">';

        foreach ($flashes as $type => $flash) {
            if (!isset($this->alertTypes[$type])) {
                continue;
            }

            foreach ((array) $flash as $i => $message) {
                ?>
                <div class="toast align-items-center text-white <?= $this->alertTypes[$type] ?> border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            <?= $message ?>
                        </div>
                        <button type="button" class="btn-close btn-close-white m-auto p-3" data-bs-dismiss="toast" aria-label="Закрыть"></button>
                    </div>
                </div>                
                <?
            }

            $session->removeFlash($type);
        }

        echo '</div>';

        $this->getView()->registerJs('
            $(".toast").map(function() {
                new bootstrap.Toast(this).show();
            })
        ');
    }
}


