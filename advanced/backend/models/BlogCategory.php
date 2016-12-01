<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "blog_category".
 *
 * @property integer $blog_id
 * @property integer $category_id
 */
class BlogCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blog_id', 'category_id'], 'required'],
            [['blog_id', 'category_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'blog_id' => '文章ID',
            'category_id' => '栏目ID',
        ];
    }
}
