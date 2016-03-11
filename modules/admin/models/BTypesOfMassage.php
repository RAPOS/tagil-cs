<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "b_types_of_massage".
 *
 * @property integer $id_massage
 * @property string $name
 * @property string $translate
 * @property string $description
 * @property integer $duration
 * @property integer $exclusive
 * @property string $keywords
 * @property string $images
 */
class BTypesOfMassage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'b_types_of_massage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'duration', 'keywords'], 'required'],
            [['description', 'images'], 'string'],
            [['duration', 'sort', 'exclusive'], 'integer'],
            [['name', 'translate'], 'string', 'max' => 64],
            [['keywords'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_massage' => 'ID',
            'name' => 'Название',
            'translate' => 'Транслит',
            'description' => 'Описание',
            'duration' => 'Продолжительность',
            'keywords' => 'Ключевые слова',
            'images' => 'Изображения',
            'sort' => 'Сотировка',
            'exclusive' => 'Эксклюзивная',
        ];
    }
	
	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			$this->translate = Yii::$app->general->translate($this->name);
			
			if($this->isNewRecord){
				$sort_count = self::find()->count();
				$this->sort = $sort_count + 1;
			}
			return true;
		} else {
			return false;
		}
	}
}
