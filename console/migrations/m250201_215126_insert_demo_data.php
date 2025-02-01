<?php

use yii\db\Migration;

/**
 * Class m250201_215126_insert_demo_data
 */
class m250201_215126_insert_demo_data extends Migration //демо данные в каталог фильмов и несколько сеансов.
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Демо-фильмы
        $demoFilms = [
            ['Интерстеллар', 'Фантастический фильм про космос', 169, 12, '1.jpg'],
            ['Матрица', 'Культовый фильм про виртуальную реальность', 136, 16, '2.jpg'],
            ['Властелин колец', 'Фэнтези про Кольцо Всевластия', 178, 12, '3.jpg'],
        ];

        // Вставляем фильмы
        $this->batchInsert(
            '{{%film_catalog}}',
            ['title', 'description', 'duration', 'age_restriction', 'pict'],
            $demoFilms //пригодится для удаления только их.
        );

        // Получаем ID вставленных фильмов
        $filmIds = (new \yii\db\Query())
            ->select(['id', 'duration'])
            ->from('{{%film_catalog}}')
            ->where(['title' => array_column($demoFilms, 0)])
            ->indexBy('id')
            ->all();

        // Демо даты для сеансов (чтобы без прошедших)
        $startTimes = [
            date('Y-m-d H:i:s', strtotime('+3 days 18:00:00')),
            date('Y-m-d H:i:s', strtotime('+5 days 20:00:00')),
            date('Y-m-d H:i:s', strtotime('+7 days 17:00:00')),
        ];

        $sessionData = []; //массив для вставки в сеансы
        $i = 0;
        foreach ($filmIds as $filmId => $film) {
            $startTime = $startTimes[$i];
            $endTime = date('Y-m-d H:i:s', strtotime("+{$film['duration']} minutes", strtotime($startTime)));
            $sessionData[] = [$filmId, $startTime, $endTime, rand(400, 600)];
            $i++;
        }

        // Вставляем сеансы
        if (!empty($sessionData)) {
            $this->batchInsert(
                '{{%film_sessions}}',
                ['film_id', 'start_datetime', 'end_datetime', 'price'],
                $sessionData
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Поскольку поле в таблице фильмов помечено "уникальное", то можно удалить по имени
        $demoTitles = ['Интерстеллар', 'Матрица', 'Властелин колец'];

        // Удаляем только демо-фильмы - сеансы удалятся автоматически
        $this->delete('{{%film_catalog}}', ['title' => $demoTitles]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250201_215126_insert_demo_data cannot be reverted.\n";

        return false;
    }
    */
}
