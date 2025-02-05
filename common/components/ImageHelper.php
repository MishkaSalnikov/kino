<?php
namespace common\components;

use Yii;

class ImageHelper
{
    public static function getImageUrl($id, $pict)
    {
        $uploadPathUrl = Yii::$app->params['uploadPathUrl'];
        $uploadPath = Yii::$app->params['uploadPath'];
        $img = $uploadPathUrl."{$id}.{$pict}";

        if (!file_exists($uploadPath . "{$id}.{$pict}")) {
            return $uploadPathUrl."no-image.png";
        }

        return $img;
    }
}
