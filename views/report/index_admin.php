<?php

use app\models\Report;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\ReportSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin();?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'number',
            'description:ntext',
            'user',
            [
                'attribute' => 'status',
                'content' => function($report) {
                    $html = Html::beginForm(['update', 'id' => $report->id]);
                    $html .= Html::activeDropDownList($report, 'status_id', [
                        2 => 'Подтверждено',
                        3 => 'Отклонено'
                    ],
                    [
                        'prompt' => [
                            'text' => 'Новая',
                            'options' => [
                                'style' => 'display:none'
                            ]
                        ]
                    ]
                );
                $html .= Html::submitButton('Подтвердить', ['class' => 'btn btn-link']);
                $html .= Html::endForm();
                return $html;
                }
            ],
        ],
    ]); ?>


<?php Pjax::end();?>
</div>
