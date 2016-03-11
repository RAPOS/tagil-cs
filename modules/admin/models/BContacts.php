<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "b_contacts".
 *
 * @property integer $site
 * @property string $title
 * @property string $text
 */
class BContacts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'b_contacts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text'], 'required'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 64]
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
        ];
    }
}
