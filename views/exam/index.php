<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exams';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .deadline {
        animation: color-change 1s infinite;
    }

    @keyframes color-change {
        0% { color: red; }
        50% { color: blue; }
        100% { color: green; }
    }
</style>
<div class="exam-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить экзамен', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Посчитать дедлайн', ['exam/need-day'], ['class' => 'btn btn-primary']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'title',
                'label' => 'Название',
            ],
            [
                'attribute' => 'start_time',
                'label' => 'Дата дедлайна',
                'content' => function($data){
                    if ($data->start_time == 0){
                        return 'не рассчитан';
                    }
                    return '<span class="deadline" style="font-weight: bold;">'.date('d.m.Y', $data->start_time).'</span>';
                }
            ],
            [
                'attribute' => 'need_day',
                'label' => 'Количество дней для подготовки',
            ],
            [
                'attribute' => 'exam_day',
                'label' => 'Дата экзамена',
                'content' => function($data){
                    return date('d.m.Y', $data->exam_day);
                }
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {delete}'],
        ],
    ]); ?>


</div>
