<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "b_mainpage_masters".
 *
 * @property integer $site
 * @property string $text
 */
class BMainpageMasters extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'b_mainpage_masters';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site', 'text'], 'required'],
            [['site'], 'integer'],
            [['text'], 'string'],
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
            'text' => 'Описание',
        ];
    }
}
