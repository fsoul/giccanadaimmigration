<?php


echo '<pre>';
print_r($_POST);
echo '</pre>';
echo '<hr>';

$array = filter_input_array(INPUT_POST);

echo '<pre>';
print_r($array);
echo '</pre>';
echo '<hr>';


$newArray = array();
foreach (array_keys($array) as $fieldKey) {
    foreach ($array[$fieldKey] as $key=>$value) {
        $newArray[$key][$fieldKey] = $value;
    }
}
echo '<pre>';
print_r($newArray);
echo '</pre>';
echo '<hr>';


?>
<? if(!empty($_POST['relative'])) : ?>
    <h3>Родственники в Канаде</h3>
    <?
        foreach ($_POST['relative'] as $persons){
            foreach ($persons as $person){
                echo "<p>{$person}</p>";
            }
        }
    ?>

<? endif; ?>

<? if(!empty($_POST['relative'])) : ?>
    <h3>Родственники в Канаде</h3>
    <? foreach ($_POST['relative'] as $k => $persons) : ?>

        <p>
            Фамилия: <?= $_POST['relative'][$k]['asa-rel-last-name']; ?>
        </p>
        <p>
            Имя: <?= $_POST['relative'][$k]['ass-rel-first-name']; ?>
        </p>
        <p>
            Отчество: <?= $_POST['relative'][$k]['ass-rel-middle-name']; ?>
        </p>
        <p>
            Родственные связи с вами: <?= $_POST['relative'][$k]['ass-rel-with']; ?>
        </p>
        <p>
            Статус в Канаде: <?= $_POST['relative'][$k]['ass-rel-status']; ?>
        </p>
        <p>
            Провинция в Канаде: <?= $_POST['relative'][$k]['ass-rel-province']; ?>
        </p>

    <? endforeach; ?>
<? endif; ?>


