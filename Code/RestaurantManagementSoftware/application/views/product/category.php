<?php

/* 
 *  <copyright file="category.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-11-17</date>
 *  <summary>Add/Update a product category.</summary>
 */
if (!isset($category)) {
    $category = new Model_ProductCategory(-1, '', '', '', -1); 
}  

if (!isset($pageName)) {
    $pageName = 'Add Product Category';
}

if (!isset($submitAction)) {
    $submitAction = 'productCategory/add';
}

?>
<h1><?php echo $pageName; ?></h1>
<?php
echo Form::open($submitAction);
echo Form::hidden('id', $category->getId()) . "<br/>";
echo Form::hidden('order', $category->getOrder()) . "<br/>";
echo Form::label('name', 'Name :');
echo Form::input('name', $category->getName()) . "<br/>";
echo Form::label('parent', 'Parent :');
?>
<select name='parent'>
    <option value='-1'>None</option>
    <?php foreach ($parents as $p) { 
        $selectionText = ($p->getId() == $category->getParent()) ? 'selected="selected"' : ''; ?>
    <option value='<?php echo $p->getId(); ?>' <?php echo $selectionText; ?> >
        <?php echo $p->getName(); ?>
    </option>
    <?php } ?>
</select> </br>
<?php
echo Form::submit(NULL, 'Save');
echo Form::close();
?>  