<?php
namespace backend\components;
use Yii;
use mdm\admin\components\AccessControl;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MyBehavior
 *
 * @author fengbo
 */
class MyBehavior  extends \yii\base\ActionFilter{
    
    //put your code here
    public function beforeAction($action) {
        var_dump(111);
        return true;
    }
}
