<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "b_actions".
 *
 * @property integer $id
 * @property string $text
 * @property string $date
 * @property integer $status
 */
class BActions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'b_actions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text','status'], 'required'],
            [['status'], 'integer'],
            [['text'], 'string', 'max' => 255],
            [['date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Текст',
            'date' => 'Дата',
            'status' => 'Статус',
        ];
    }
}
