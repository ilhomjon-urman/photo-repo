<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "photo_files".
 *
 * @property int $id
 * @property int $album_id
 * @property string $original_name
 * @property string $changed_name
 * @property int $created_at
 *
 * @property PhotoAlbum $album
 */
class PhotoFiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'photo_files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['album_id', 'original_name', 'changed_name', 'created_at'], 'required'],
            [['album_id', 'created_at'], 'integer'],
            [['original_name', 'changed_name'], 'string', 'max' => 1024],
            [['album_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhotoAlbum::className(), 'targetAttribute' => ['album_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'album_id' => 'Album ID',
            'original_name' => 'Original Name',
            'changed_name' => 'Changed Name',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Album]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlbum()
    {
        return $this->hasOne(PhotoAlbum::className(), ['id' => 'album_id']);
    }
}
