<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exams';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Exam', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Exec need day', ['exam/need-day'], ['class' => 'btn btn-primary']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'start_time',
                'label' => 'Deadline',
                'content' => function($data){
                    if ($data->start_time == 0){
                        return 'unavailable';
                    }
                    return date('d.m.Y', $data->start_time);
                }
            ],
            'need_day',
            [
                'attribute' => 'exam_day',
                'content' => function($data){
                    return date('d.m.Y', $data->exam_day);
                }
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {delete}'],
        ],
    ]); ?>


</div>
