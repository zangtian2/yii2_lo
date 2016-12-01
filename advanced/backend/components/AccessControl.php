<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\components;
use Yii;
use yii\web\ForbiddenHttpException;

/**
 * Description of AccessControl
 *
 * @author fengbo
 */
class AccessControl extends \yii\base\ActionFilter
{
    //put your code here
    /**
     *  对用户请求的路由进行验证
     *  @return true 表示有权访问
     */
    public function beforeAction($action) {
        //当前路由
        $actionId = $action->getUniqueId();
        $actionId = '/'.$actionId;
        
        //当前登录的用户id
        $user = Yii::$app->getUser();
        $userId = $user->id;
        
        //获取当前用户已经分配过的路由权限
        $routes = [];
        $manage = Yii::$app->getAuthManager();
        foreach ($manage->getPermissionsByUser($userId) as $name=> $value) {
            if($name[0] === '/'){
                $routes = $name;
            }
            
            //判断当前用户是否有权限访问正在请求的路由
            if(in_array($actionId, $routes)){
                return true;
            }
            
            $this->denyAccess($user);            
        }        
    }
    
    /**
     *  拒绝用户访问
     * 访客，跳转去登录；已登录，抛出403
     * @params $user 当前用户
     * @throws ForbiddenHttpException 如果用户已经登录，抛出403
     */
    public function denyAccess($user){
        if($user->getIsGuest()){
            $user->loginRequired();
        }else{
            throw new ForbiddenHttpException('不允许访问.');
        }
    }
}
