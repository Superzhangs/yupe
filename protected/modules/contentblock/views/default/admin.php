<?php
$this->breadcrumbs = array(
    $this->getModule('contentblock')->getCategory() => array(''),
    Yii::t('contentblock', 'Блоки контента') => array('admin'),
    Yii::t('contentblock', 'Управление'),
);

$this->menu = array(
    array('icon'  => 'plus-sign','label' => Yii::t('contentblock', 'Добавить новый блок'), 'url' => array('/contentblock/default/create')),
    array('icon' => 'list-alt','label' => Yii::t('contentblock', 'Управление блоками контента'), 'url' => array('/contentblock/default/admin')),
);
?>

<div class="page-header">
    <h1>
        <?php echo Yii::t('contentblock', 'Блоки контента'); ?>
        <small><?php echo Yii::t('contentblock', 'управление'); ?></small>
    </h1>
</div>

<button class="btn btn-small dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
    <i class="icon-search">&nbsp;</i>
    <?php echo CHtml::link(Yii::t('contentblock', 'Поиск блоков контента'), '#', array('class' => 'search-button')); ?>
    <span class="caret">&nbsp;</span>
</button>

<div id="search-toggle" class="collapse out search-form">
<?php
Yii::app()->clientScript->registerScript('search', "
    $('.search-form form').submit(function() {
        $.fn.yiiGridView.update('content-block-grid', {
            data: $(this).serialize()
        });
        return false;
    });
");
$this->renderPartial('_search', array('model' => $model));
?>
</div>

<br/>

<p><?php echo Yii::t('contentblock', 'В данном разделе представлены средства управления блоками контента'); ?></p>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'content-block-grid',
    'dataProvider' => $model->search(),
    'type'=>'condensed',
    'columns' => array(
        'id',
        array(
            'name' => 'name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->name, array("/contentblock/default/update", "id" => $data->id))',
        ),
        array(
            'name' => 'type',
            'value' => '$data->getType()',
        ),
        'code',
        'description',
        array('class' => 'bootstrap.widgets.TbButtonColumn'),
   ),
 )); ?>