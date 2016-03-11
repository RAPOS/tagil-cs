<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "b_sertificates".
 *
 * @property integer $site
 * @property string $title
 * @property string $text
 * @property string $images
 */
class BSertificates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'b_sertificates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site', 'title', 'text'], 'required'],
            [['site'], 'integer'],
            [['text', 'images'], 'string'],
            [['title'], 'string', 'max' => 64],
            [['site'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'site' => 'Site',
            'title' => 'Заголовок',
            'text' => 'Текст',
            'images' => 'Изображения',
        ];
    }
}
