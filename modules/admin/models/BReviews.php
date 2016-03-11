<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "b_reviews".
 *
 * @property integer $id
 * @property string $email
 * @property string $name
 * @property string $text
 * @property string $date
 * @property string $section
 * @property string $translate
 * @property integer $moderate
 * @property string $ip
 */
class BReviews extends \yii\db\ActiveRecord
{
	public $verifyCode;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'b_reviews';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'name', 'text', 'verifyCode'], 'required'],
            [['text'], 'string'],
            [['moderate'], 'integer'],
            [['date'], 'safe'],
            [['email', 'name', 'section', 'translate', 'ip'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'E-mail',
            'name' => 'Имя',
            'text' => 'Текст',
            'date' => 'Дата',
            'section' => 'Раздел сайта',
            'translate' => 'Транслит названия страницы',
            'moderate' => 'Публикаця',
            'verifyCode' => 'Проверочный код',
            'ip' => 'IP',
        ];
    }
}
