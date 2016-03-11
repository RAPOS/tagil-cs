<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "b_images".
 *
 * @property integer $id_img
 * @property string $name
 * @property string $page
 * @property string $path
 * @property string $extension
 */
class BImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'b_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'extension'], 'required'],
            [['name'], 'string', 'max' => 32],
            [['path'], 'string', 'max' => 256],
            [['extension'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_img' => 'Id Img',
            'name' => 'Name',
            'path' => 'Path',
            'extension' => 'Extension',
        ];
    }
}
