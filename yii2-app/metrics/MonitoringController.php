<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;
use Prometheus\Storage\InMemory;

class MonitoringController extends Controller
{
    public function actionMetrics()
    {
        $this->enableCsrfValidation = false;
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $this->layout = false;

        $registry = new CollectorRegistry(new InMemory());

        $counter = $registry->getOrRegisterCounter('yii2_app', 'http_requests_total', 'Total HTTP requests');
        $counter->inc();
        
        $renderer = new RenderTextFormat();
        $metrics = $renderer->render($registry->getMetricFamilySamples());

        Yii::$app->response->headers->set('Content-Type', RenderTextFormat::MIME_TYPE);
        return $metrics;
    }
}
