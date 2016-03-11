<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "b_settings".
 *
 * @property integer $site
 * @property string $title
 * @property string $keywords
 * @property string $description
 */
class BSettings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'b_settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'keywords', 'description'], 'required'],
            [['site'], 'integer'],
            [['title'], 'string', 'max' => 64],
            [['keywords', 'description'], 'string', 'max' => 256],
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
            'keywords' => 'Ключевые слова',
            'description' => 'Описание',
        ];
    }
}