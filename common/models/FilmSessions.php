<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "film_sessions".
 *
 * @property int $id
 * @property int|null $film_id
 * @property string|null $start_datetime
 * @property string|null $end_datetime
 * @property int|null $price
 *
 * @property FilmCatalog $film
 */
class FilmSessions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'film_sessions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['film_id'], 'integer'],
            [['start_datetime', 'end_datetime'], 'safe'],
            [['film_id'], 'exist', 'skipOnError' => true, 'targetClass' => FilmCatalog::class, 'targetAttribute' => ['film_id' => 'id']],
            [['price'], 'integer', 'min' => 1, 'max' => 1000],
            [['film_id', 'start_datetime', 'price'], 'required'],
            ['start_datetime', 'validateSessionOverlap'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'film_id' => 'Фильм',
            'start_datetime' => 'Дата и время начала сеанса',
            'end_datetime' => 'End Datetime',
            'price' => 'Цена',
        ];
    }

    /**
     * Gets query for [[Film]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFilm()
    {
        return $this->hasOne(FilmCatalog::class, ['id' => 'film_id']);
    }

    /**
     * Update query for [[filmSession]]
     */
    public function updateEndDatetime()
    {
        if (!$this->id) {
            return false;
        }

        return \Yii::$app->db->createCommand("
        UPDATE film_sessions fs
        JOIN film_catalog fc ON fs.film_id = fc.id
        SET fs.end_datetime = DATE_ADD(fs.start_datetime, INTERVAL fc.duration MINUTE)
        WHERE fs.id = :id
    ")->bindValue(':id', $this->id)
            ->execute();
    }
    //проврка на пересечение сеансов
    public function validateSessionOverlap($attribute, $params)
    {
        if (!$this->film) {
            $this->addError($attribute, 'Не выбран фильм.');
            return;
        }
        //время для проверки пересечения сеансов + 30мин в обе стороны
        $duration = $this->film->duration;
        $startTimestamp = strtotime($this->$attribute);
        $endTimestamp = $startTimestamp + $duration * 60;
        $buffer = 30 * 60;
        $checkStart = $startTimestamp - $buffer;
        $checkEnd   = $endTimestamp + $buffer;
        $checkStartFormatted = date('Y-m-d H:i:s', $checkStart);
        $checkEndFormatted   = date('Y-m-d H:i:s', $checkEnd);

        $query = self::find()
            ->where(['<>', 'id', $this->id])
            ->andWhere('start_datetime < :checkEnd AND end_datetime > :checkStart', [
                ':checkEnd'   => $checkEndFormatted,
                ':checkStart' => $checkStartFormatted,
            ]);

        $exists = $query->exists();

        if ($exists) {
            $this->addError($attribute, 'Время сеанса пересекается с другим сеансом, учитывая 30-минутный зазор.');
        }
    }


}
