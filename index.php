<?php
require_once './RevertCharacters.php';

$string = 'Привет! Давно не виделись.';
$revertModel = new RevertCharacters();
?>

<h4>Исходная строка:</h4>
<p><?= $string ?></p>

<h4>Перевернем ее:</h4>
<?php $string = $revertModel->revertCharacters($string); ?>
<p><?= $string ?></p>

<h4>А теперь вернем к исходной (перевернем еще раз):</h4>
<?php $string = $revertModel->revertCharacters($string); ?>
<p><?= $string ?></p>