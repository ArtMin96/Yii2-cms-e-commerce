<?php

namespace backend\controllers;

use common\components\Helper;
use common\models\Seo;
use Yii;
use common\models\Pages;
use common\models\PagesSearch;
use yii\base\Model;
use yii\db\Exception;
use yii\db\Transaction;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PagesController implements the CRUD actions for Pages model.
 */
class PagesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pages' => Pages::getRoot()
        ]);
    }

    /**
     * Displays a single Pages model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pages();
        $seo = new Seo();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $seo->load(Yii::$app->request->post());

            $transaction = Yii::$app->db->beginTransaction();

            try {
                $valid = $model->validate();
                $valid = $seo->validate() && $valid;

                if ($valid) {
                    $model->save();

                    $seo->page_id = $model->id;
                    $seo->meta_image = UploadedFile::getInstance($seo, 'meta_image');
                    $seo->og_image = UploadedFile::getInstance($seo, 'og_image');
                    $seo->twitter_image = UploadedFile::getInstance($seo, 'twitter_image');

                    $seo->save();

                    $transaction->commit();
                    return $this->redirect(['update', 'id' => $model->id]);
                } else {
                    $transaction->rollBack();
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw new BadRequestHttpException($e->getMessage(), 0, $e);
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'seo' => $seo,
            'activePages' => Pages::getActivePages(),
        ]);
    }

    /**
     * Updates an existing Pages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $seo = Seo::findOne(['page_id' => $id]);

        if (empty($seo)) {
            $seo = new Seo();
        }

        if (Yii::$app->request->isPost) {

            $model->load(Yii::$app->request->post());
            $seo->load(Yii::$app->request->post());

            $transaction = Yii::$app->db->beginTransaction();

            try {
                $valid = $model->validate();
                $valid = $seo->validate() && $valid;

                if ($valid) {
                    $model->save();

                    $post = Yii::$app->request->post();

                    if (!empty($post['Seo']['meta_keywords'])) {
                        $keywords = implode(',', $post['Seo']['meta_keywords']);
                    }
                    $seo->meta_keywords = $keywords;

                    $seo->meta_image = UploadedFile::getInstance($seo, 'meta_image');
                    $seo->og_image = UploadedFile::getInstance($seo, 'og_image');
                    $seo->twitter_image = UploadedFile::getInstance($seo, 'twitter_image');

                    $seo->save(false);

                    $transaction->commit();
                    return $this->redirect(['update', 'id' => $model->id]);
                } else {
                    $transaction->rollBack();
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw new BadRequestHttpException($e->getMessage(), 0, $e);
            }
        }

//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }

        return $this->render('update', [
            'model' => $model,
            'seo' => $seo,
            'skipedNodes' => Pages::skipSelectedNodeChilds($id),
            'activePages' => Pages::getActivePages(),
        ]);
    }

    /**
     * Deletes an existing Pages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $page = Pages::getChildrenString($id);

        foreach ($page as $ids) {
            Pages::findOne($ids)->delete();
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pages::find()->where(['id' => $id])->multilingual()->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
