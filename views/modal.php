<?php
/**
 * Created by PhpStorm.
 * User: dench
 * Date: 19.12.17
 * Time: 15:05
 *
 * @var $options array
 * @var $titleTag string
 * @var $titleOptions string
 * @var $size string
 * @var $close boolean
 * @var $center boolean
 */

use yii\helpers\Html;

?>
<div class="modal <?= $options['class'] ?> fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog<?= $center ? ' modal-dialog-centered' : '' ?><?= $size ? ' ' . $size : '' ?>" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?= Html::tag($titleTag, '', $titleOptions) ?>
                <?php if ($close) : ?>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?php endif; ?>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
