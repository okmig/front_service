<?php
use yii\helpers\Html;
?>

<?php if ($status): ?>
<p>You have successfully registered as <?= Html::encode($model->username) ?></p>
<?php endif ?>

<?php if (!$status): ?>
<?= Html::encode($message) ?>
<?php endif ?>