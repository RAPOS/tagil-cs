<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "b_masters".
 *
 * @property integer $id_master
 * @property string $name
 * @property string $translate
 * @property string $description
 * @property string $keywords
 * @property string $images
 * @property integer $sort
 * @property integer $age
 * @property integer $growth
 * @property integer $weight
 * @property integer $breast
 * @property integer $new
 * @property integer $tour
 */
class BMasters extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'b_masters';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'keywords', 'age', 'growth', 'weight', 'breast'], 'required'],
            [['description', 'images'], 'string'],
            [['sort', 'age', 'growth', 'weight', 'breast', 'new', 'tour'], 'integer'],
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
            'id_master' => 'ID',
            'name' => 'Имя',
            'translate' => 'Транслит',
            'description' => 'Описание',
            'keywords' => 'Ключевые слова',
            'images' => 'Изображения',
            'sort' => 'Сотировка',
            'age' => 'Возраст',
            'growth' => 'Рост',
            'weight' => 'Вес',
            'breast' => 'Бюст',
            'new' => 'Новенькая',
            'tour' => 'На гастролях',
        ];
    }
	
	/**/
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
