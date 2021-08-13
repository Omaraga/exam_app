<?php

namespace app\models;

use phpDocumentor\Reflection\Types\Integer;
use Yii;

/**
 * This is the model class for table "exam".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $start_time
 * @property int $need_day
 * @property int $exam_day
 */
class Exam extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'exam';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Title',
            'start_time' => 'Start Time',
            'need_day' => 'Need Day to prepare',
            'date' => 'Choose exam date',
        ];
    }

    /**
     * @param $canDayByExam array
     * @param $exam Exam
     */

    private static function addCanDays(&$canDayByExam, $exam){
        for ($i = 1; $i <= $exam->need_day; $i++ ){
            $prepareDay = $exam->exam_day - 3600 * 24 * $i;
            $canDayByExam[$exam->id][] = $prepareDay;
        }
    }

    /**
     * @param $canDayByExam array
     * @param $day Integer
     */

    private static function deleteCanDays(&$canDayByExam, $day){
        foreach ($canDayByExam as $key => $dayList){
            if (($idx = array_search($day, $dayList)) !== false) {
                unset($dayList[$idx]);
                $canDayByExam[$key] = $dayList;
            }
        }
    }

    /**
     * set start_time attribute
     */
    public static function setNeedDay(){
        $canDayByExam = [];
        /* сортировка по количеству дней */
        $exams = self::find()->orderBy('need_day asc')->all();
        /*Заполняем массив с возможными днями для каждого экзамена*/
        foreach ($exams as $exam){
            self::addCanDays($canDayByExam, $exam);
        }
        /*Уделяем из массива возможных дней дни экзаменов*/
        foreach ($exams as $exam){
            self::deleteCanDays($canDayByExam, $exam->exam_day);
        }
        /*сперва вычисляем для экзаменова у которого меньше возможных дней
        а из массива возможных дней удаляем эти дни.
        */
        foreach ($exams as $exam){
            $days = $canDayByExam[$exam->id];
            if (isset($days) && is_array($days) && sizeof($days) > 0){
                $day = array_shift($days);
                self::deleteCanDays($canDayByExam, $day);
            }else{
                $day = 0;
            }
            $exam->start_time = $day;
            $exam->save(false);
        }


    }

}
