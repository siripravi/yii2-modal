<?php
/**
 * Created by PhpStorm.
 * User: dench
 * Date: 19.12.17
 * Time: 16:00
 */

namespace dench\modal;

use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

class Modal extends Widget
{
    public $modalClass = 'modal-load';

    public $options;

    public $titleTag = 'h5';

    public $titleOptions;

    public $size;

    public $close = true;

    public $center = false;

    public function run()
    {
        $view = $this->getView();

        $js = <<<JS
function modalLoad(obj, data) {
    renderData(obj, data.title, '.modal-title');
    renderData(obj, data.body, '.modal-body');
    renderData(obj, data.footer, '.modal-footer');
    obj.find('.modal-dialog').removeClass('modal-lg').removeClass('modal-sm').addClass(data.size);
    obj.addClass(data.class);
}
function renderData(obj, data, sel) {
    if (data) {
        obj.find(sel).html(data).show();
    } else {
        obj.find(sel).hide();
    }
}
function openModal(action = null, config = {}) {
    $('.g-recaptcha').remove();
    if (action === null) {
        var obj = $('.{$this->modalClass}');
        modalLoad(obj, config);
        obj.modal('show');
    } else {
        $.getJSON(action, function(data){
            var obj = $('.{$this->modalClass}');
            config = $.extend(data, config);
            modalLoad(obj, data);
            obj.modal('show');
        });
    }
}
JS;
        $view->registerJs($js, View::POS_END);

$js = <<<JS
$(document).on('click', '*[data-modal]', function(e){
    e.preventDefault();
    var config = {
        size: $(this).attr('data-modal-size'),
        title: $(this).attr('data-modal-title'),
        body: $(this).attr('data-modal-body'),
        footer: $(this).attr('data-modal-footer'),
        class: $(this).attr('data-modal-class')
    };
    openModal($(this).attr('data-modal'), config);
});
$(document).on('click', '.{$this->modalClass} button[type="submit"]', function(){
    $('.{$this->modalClass} form').trigger('beforeSubmit');
});
$(document).on('beforeSubmit', '.{$this->modalClass} form', function(){
    var form = $(this);
    $.post(form.attr('action'), form.serialize(), function(data){
        modalLoad($('.{$this->modalClass}'), data);
    }, 'json');
    return false;
});
JS;
        $view->registerJs($js);

        Html::addCssClass($this->titleOptions, 'modal-title');

        Html::addCssClass($this->options, $this->modalClass);

        return $this->render('modal', [
            'options' => $this->options,
            'titleTag' => $this->titleTag,
            'titleOptions' => $this->titleOptions,
            'size' => $this->size,
            'close' => $this->close,
            'center' => $this->center,
        ]);
    }
}
