<?php

namespace backend\models;
use yii\base\Model;
use backend\models\UserBackend;

/**
 * This is the model class for table "user_backend".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $email
 * @property string $created_at
 * @property string $updated_at
 */
class SignupForm extends Model
{   
    public $username;
    public $email;
    public $password;
    
    public $created_at;
    public $updated_at;
    
    /*
     * @inheritdoc
     * 对数据的效验规则
     */
    public function rules() {                   
        return [
            //对username的值进行两边取出空格过滤
            ['username','filter','filter'=>'trim'],
            
            //required表示必须的，也就是说表单提交过来的值必须要有，message 是username不满足requried规则时给出的提示信息
            ['username','required','message'=>'用户名不可以为空'],
            
            //unique表示唯一性，targetClass表示的数据模型，就是说UserBackend模型对应的数据表字段username必须唯一
            ['username','unique','targetClass'=> '\backend\models\UserBackend','message'=>'用户名已存在.'],
            
            //string 字符串，username至少包含两个字符，最多255个字符
            ['username','string','min'=>2,'max'=>255],
            
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required', 'message' => '邮箱不可以为空'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\backend\models\UserBackend', 'message' => 'email已存在.'],
            ['password', 'required', 'message' => '密码不可以为空'],
            ['password', 'string', 'min' => 6, 'tooShort' => '密码至少填写6位'],   
            // default 默认在没有数据的时候才会进行赋值
            [['created_at', 'updated_at'], 'default', 'value' => date('Y-m-d H:i:s')],
        ];
    }
    
    /**
     * Signs user up.
     * @return true|false 添加成功或失败
     */
    public function signup(){
        if (!$this->validate()){
            return null;
        }
        
        //对数据入库操作
        $user = new UserBackend();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->created_at = $this->created_at;   
        $user->updated_at = $this->updated_at;
        
        //设置密码
        $user->setPassword($this->password);
        
        //生成 'remeber me' 认证key
        $user->generateAuthKey();
        
        //save(false):不再调用rules效验，进行入库
        return $user->save(false);
    }
   
}
