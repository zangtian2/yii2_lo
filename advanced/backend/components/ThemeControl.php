<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\components;

use Yii;
use yii\base\Object;
/**
 * Description of ThemeControl
 *
 * @author fengbo
 */
class ThemeControl extends \yii\base\ActionFilter {
    //put your code here
    public function init(){
        $switch = intval(\Yii::$app->request->get('switch'));
        $theme = $switch ? 'spring' : 'christmas';  //主题不存在时，则默认主题显示
        
        Yii::$app->view->theme = Yii::createObject([
            'class' => 'yii\base\Theme',
            'pathMap' => ['@app/views' => [
                "@app/themes/{$theme}",
                ]
            ],
         ]);                    
    }
}
