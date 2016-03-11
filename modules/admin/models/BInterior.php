<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "b_interior".
 *
 * @property integer $site
 * @property string $title
 * @property string $text
 * @property string $images
 */
class BInterior extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'b_interior';
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
            'text' => 'Описание',
            'images' => 'Images',
        ];
    }
}
