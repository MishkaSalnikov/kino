<?php

namespace common\models;


use Yii;
use yii\web\UploadedFile;


/**
 * This is the model class for table "film_catalog".
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int $duration
 * @property int $age_restriction
 * @property string|null $pict
 *
 * @property FilmSessions[] $filmSessions
 */
class FilmCatalog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'film_catalog';
    }


    public function init() //не пойму почему без этого не работают дефолтные значения.. после генерации через gii работало без инит
    {
        parent::init();
        $this->duration = 90;
        $this->age_restriction = 18;
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'duration', 'age_restriction'], 'required'],
            [['age_restriction'], 'integer', 'min' => 0, 'max' => 100],
            [['age_restriction'], 'default', 'value' => 18],
            [['title'], 'string', 'max' => 255],
            [['duration'], 'integer', 'min' => 0, 'max' => 1000],
            [['duration'], 'default', 'value' => 90],
            [['description'], 'string', 'max' => 2000],
            //[['pict'], 'string', 'max' => 5],
            [
                'pict',
                'image',
                'extensions' => 'png, jpg, webp',
                'minWidth' => 300,
                'maxWidth' => 3000,
                'minHeight' => 300,
                'maxHeight' => 3000,
            ],
            [['title'], 'unique'],
        ];
    }
/*
 public function rules()
    {
        return [
            [['title'], 'required'],
            [['duration', 'age_restriction'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 2000],
            [['pict'], 'string', 'max' => 5],
            [['title'], 'unique'],
        ];
    }
 */
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Наименование*',
            'description' => 'Описание',
            'duration' => 'Длительность в минутах*',
            'age_restriction' => 'Возрастные ограничения*',
            'pict' => 'Постер (от 300 до 3000px)',
        ];
    }



    public function saveUploadedImage(?UploadedFile $uploadedFile)
    {
        // Если файл отсутствует, ничего не делаем
        if (!$uploadedFile) {
            return true; // Возвращаем успех, так как это не критичная ситуация
        }

        $fileName = $this->id . '.' . $uploadedFile->getExtension();
        $uploadPath = Yii::getAlias(Yii::$app->params['uploadPath']);
        $filePath = $uploadPath . $fileName;

        // Сохраняем файл на диск
        if ($uploadedFile->saveAs($filePath)) {
            $this->pict = $uploadedFile->getExtension();
            return $this->save(false); // Сохраняем обновленные данные в БД
        }

        return false; // Если файл не удалось сохранить
    }

    public function getImageUrl()
    {
        $uploadPathUrl = Yii::$app->params['uploadPathUrl'];
        $uploadPath = Yii::$app->params['uploadPath'];
        $img = $uploadPathUrl."{$this->id}.{$this->pict}";

        // Проверяем существование файла
        if (!file_exists($uploadPath . "{$this->id}.{$this->pict}")) {
            return $uploadPathUrl."no-image.png";
        }

        return $img;
    }

    public function deleteImage()
    {
        $uploadPath = Yii::$app->params['uploadPath'];
        $img = $uploadPath . "{$this->id}.{$this->pict}";

        if (file_exists($img)) {
            unlink($img);
        }
    }


}
