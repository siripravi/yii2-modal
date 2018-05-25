Modal widget for Yii2
=====================
Modal widget for Yii2

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist dench/yii2-modal "*"
```

or add

```
"dench/yii2-modal": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```html
<button data-modal="/site/modal-test" data-modal-size="modal-sm">Open Modal</button>

<button onclick="openModal('/site/modal-test', { size: 'modal-lg' });">Open Modal</button>

<button onclick="openModal(null, { title: 'Title', body: 'Body' });">Open Modal</button>

<?= \dench\modal\Modal::widget(); ?>
```
```php
public function actionModalTest()
{
    $footer = Html::button('Close', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']);

    $model = new ModelForm();

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        Yii::$app->session->setFlash('success', 'Success');
    } else {
        $footer .= Html::submitButton('Ok', ['class' => 'btn btn-primary']);
    }

    $data = [
        'title' => 'Title',
        'body' => $this->renderAjax('modal-test', [
            'model' => $model,
        ]),
        'footer' => $footer,
    ];

    return Json::encode($data);
}
```

ReCaptcha
-----
```php
use himiklab\yii2\recaptcha\ReCaptcha;

echo ReCaptcha::widget();

$js = <<<JS
if (typeof grecaptcha !== 'undefined') {
    recaptchaOnloadCallback();
}
JS;
$this->registerJs($js);
```