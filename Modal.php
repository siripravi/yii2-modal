<?php
/**
 * Created by PhpStorm.
 * User: dench
 * Date: 19.12.17
 * Time: 16:00
 */

namespace dench\modal;

use yii\base\Widget;
use yii\web\View;

class Modal extends Widget
{
    public $class = "modal-load";

    public function run()
    {
        $view = $this->getView();

        $js = <<<JS
function modalLoad(obj, data) {
    renderData(obj, data.title, '.modal-title');
    renderData(obj, data.body, '.modal-body');
    renderData(obj, data.footer, '.modal-footer');
}
function renderData(obj, data, sel) {
    if (data) {
        obj.find(sel).html(data).show();
    } else {
        obj.find(sel).hide();
    }
}
function openModal(action) {
    $.getJSON(action, function(data){
        var obj = $('.{$this->class}');
        modalLoad(obj, data);
        obj.modal('show');
    });
}
JS;
        $view->registerJs($js, View::POS_END);

$js = <<<JS
$(document).on('click', '*[data-modal]', function(e){
    e.preventDefault();
    openModal($(this).attr('data-modal'));
});
$(document).on('click', '.{$this->class} button[type="submit"]', function(){
    $('.{$this->class} form').submit();
});
$(document).on('beforeSubmit', '.{$this->class} form', function(){
    var form = $(this);
    $.post(form.attr('action'), form.serialize(), function(data){
        modalLoad($('.{$this->class}'), data);
    }, 'json');
    return false;
});
JS;
        $view->registerJs($js);

        return $this->render('modal', [
            'class' => $this->class,
        ]);
    }
}