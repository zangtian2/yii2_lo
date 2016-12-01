<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;

/**
 * rbac controller
 */
class RbacController extends Controller
{
    public function actionInit(){
        $auth = Yii::$app->authManager;
        //添加 "/blog/index"权限        
        $blogIndex = $auth->createPermission('/blog/index');
        $blogIndex->description = "博客列表";
        $auth->add($blogIndex);
        
        //创建一个角色blogManager,并为该角色分配"/blog/index"权限
        $blogManager = $auth->createRole("博客管理");
        $auth->add($blogManager);
        $auth->addChild($blogManager, $blogIndex);
        
        //为用户'test1' 分配 '角色管理' 权限
        $auth->assign($blogManager, 1);
    }
    
        // 添加权限
    public function actionInit2 ()
    {
        $auth = Yii::$app->authManager;

        // 添加权限
        $blogView = $auth->createPermission('/blog/view');
        $auth->add($blogView);
        $blogCreate = $auth->createPermission('/blog/create');
        $auth->add($blogCreate);
        $blogUpdate = $auth->createPermission('/blog/update');
        $auth->add($blogUpdate);
        $blogDelete = $auth->createPermission('/blog/delete');
        $auth->add($blogDelete);

        // 分配给我们已经添加过的"博客管理"权限
        $blogManage = $auth->getRole('博客管理');
        $auth->addChild($blogManage, $blogView);
        $auth->addChild($blogManage, $blogCreate);
        $auth->addChild($blogManage, $blogUpdate);
        $auth->addChild($blogManage, $blogDelete);
    }
}
