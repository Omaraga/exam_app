<?php


namespace app\models;
use yii\base\Model;
class ExamForm extends Model
{
    public $exam_day;
    public $title;
    public $need_day;

    /**
     * @return array|array[]
     */
    public function rules()
    {
        return [
            [['exam_day', 'title', 'need_day'], 'required'],
            [['need_day'], 'integer'],
            [['title', 'exam_day'], 'string','min' => 1, 'max' => 11],
        ];
    }

    /**
     * @return bool
     */
    public function save(){
        if ($this->validate()){
            $model = new Exam();
            $model->exam_day = strtotime($this->exam_day);
            $model->need_day = $this->need_day;
            $model->title = $this->title;
            $model->title = $this->title;
            return $model->save();
        }
        return false;
    }

}