<?php

namespace app\controllers;

use Yii;
use app\models\PhotoAlbum;
use app\models\PhotoAlbumSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\PhotoFiles;
use yii\web\UploadedFile;



/**
 * PhotoAlbumController implements the CRUD actions for PhotoAlbum model.
 */
class PhotoAlbumController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all PhotoAlbum models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PhotoAlbumSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PhotoAlbum model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PhotoAlbum model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new PhotoAlbum();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PhotoAlbum model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PhotoAlbum model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionUpload($id)
    {
    
        $model = new PhotoFiles();

        if ($model->load(Yii::$app->request->post())) {
    
            $model->file = UploadedFile::getInstance($model, 'file');

            $newFileName = transliterator_transliterate('Any-Latin; Latin-ASCII; Lower();', $model->file->name);

            $fileName = $newFileName . '.' . $model->file->extension;

            $ifPhoto = PhotoFiles::findOne(['changed_name'=>$fileName]);

            if ($ifPhoto) {
                $fileName = $newFileName . '-' . md5(time()) . '.' . $model->file->extension;
            }

            $model->original_name = $model->file->name;
            $model->changed_name = $fileName;
            $model->album_id = $id;
            $model->created_at = time();

            if ($model->file && $model->validate()) {
                if($model->save()) {
                    $model->file->saveAs(Yii::$app->basePath . '/web/uploads/' . $model->changed_name);
                    return $this->redirect('/photo-album/view?id='.$id);
                }
            }
        }

        return $this->render('upload', [
            'model' => $model,
        ]);

    }


    public function actionDeleteFile($id)
    {
        $model = PhotoFiles::findOne($id);
        $albumId = $model->album->id;
        $model->delete();
        return $this->redirect('/photo-album/view?id='.$albumId);
    }


    /**
     * Finds the PhotoAlbum model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return PhotoAlbum the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PhotoAlbum::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
