<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "photo_album".
 *
 * @property int $id
 * @property string $name
 *
 * @property PhotoFiles[] $photoFiles
 */
class PhotoAlbum extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'photo_album';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[PhotoFiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoFiles()
    {
        return $this->hasMany(PhotoFiles::className(), ['album_id' => 'id']);
    }
}
