<option value="<?= $category['id'] ?>"<?=
($category['id'] == $categoryCurrent) ? ' selected' : '';
?>><?= $category['name']?></option>