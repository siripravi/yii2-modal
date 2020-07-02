<?php
/**
 * Created by PhpStorm.
 * User: dench
 * Date: 19.12.17
 * Time: 16:00
 */

namespace dench\modal;

use yii\base\Widget;
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

    public $backdrop = 'true'; // 'true'|'false'|'"static"'

    public $keyboard = 'true';

    public function run()
    {
        /* @var $view View */
        $view = $this->view;

/*        $js = <<<JS
function modalLoad(obj, data) {
    renderData(obj, data.title, '.modal-title');
    renderData(obj, data.body, '.modal-body');
    renderData(obj, data.footer, '.modal-footer');
    obj.find('.modal-dialog').attr('class', 'modal-dialog').addClass(data.dialog);
    obj.addClass(data.class).attr('data-modal-action', data.action);
    if (data.title) {
        obj.find('.modal-header').show();
    } else {
        obj.find('.modal-header').hide();
    }
    if (data.autoclose) {
        setTimeout(function(){
            $('.{$this->modalClass}').modal('hide');
            if (data.redirect) {
                window.location.href = data.redirect;
            }
        }, data.autoclose);
    }
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
    var obj = $('.{$this->modalClass}');
    $(document).trigger('tooltip');
    if (action === obj.attr('data-modal-action')) {
        obj.modal({show: true});
    } else if (action === null || action === '') {
        modalLoad(obj, config);
        if (typeof config.backdrop !== 'undefined') {
            config.backdrop = {$this->backdrop};
        }
        if (typeof config.keyboard !== 'undefined') {
            config.keyboard = {$this->keyboard};
        }
        obj.modal({
            show: true,
            backdrop: config.backdrop === 'false' ? false : true,
            keyboard: config.keyboard === 'false' ? false : true
        });
    } else {
        $.getJSON(action, function(data){
            if (data) {
                config = $.extend(config, data);
                modalLoad(obj, config);
                if (!config.backdrop) {
                    config.backdrop = {$this->backdrop};
                }
                if (!config.keyboard) {
                    config.keyboard = {$this->keyboard};
                }
                obj.modal({
                    show: true,
                    backdrop: config.backdrop === 'false' ? false : true,
                    keyboard: config.keyboard === 'false' ? false : true
                });
            }
        });
    }
}
$(document).on('click', '*[data-modal]', function(e){
    e.preventDefault();
    var config = {
        action: $(this).attr('data-modal'),
        dialog: $(this).attr('data-modal-dialog'),
        title: $(this).attr('data-modal-title'),
        body: $(this).attr('data-modal-body'),
        footer: $(this).attr('data-modal-footer'),
        class: $(this).attr('data-modal-class'),
        backdrop: $(this).attr('data-modal-backdrop'),
        keyboard: $(this).attr('data-modal-keyboard'),
        autoclose: $(this).attr('data-modal-autoclose'),
        redirect: $(this).attr('data-modal-redirect')
    };
    openModal(config.action, config);
});
$(document).on('click', '.{$this->modalClass} button[type="submit"]', function(){
    var modal = $('.{$this->modalClass}');
    modal.attr('data-modal-action', null);
    var form = modal.find('form');
    if ($(this).hasClass('fix')) {
        // VerifyPhone
        return form.trigger('beforeSubmit');
    }
    $.post(form.attr('action'), form.serialize(), function(data){
        modalLoad(modal, data);
    }, 'json');
    return false;
});
JS;
        $view->registerJs($js);*/

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
