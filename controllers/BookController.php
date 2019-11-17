<?php

namespace app\controllers;

use app\models\Book;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class BookController extends Controller
{
    public function actionApiIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return Book::getBooksSchema();
    }

    public function actionApiView($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return Book::getBookSchema($id);
    }

    /**
     * @param int $id
     * @param string $name
     * @param string $type
     */
    public function actionApiFile(int $id, string $name, string $type)
    {
        $file = Yii::getAlias("@content/kala-ha_0{$id}/{$name}.{$type}");
        if (!file_exists($file)) {
            throw new NotFoundHttpException('Файл не найден.');
        }
        return Yii::$app->response->sendFile($file);
    }
}