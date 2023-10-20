<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * RegisterForm is the model behind the register form.
 *
 */
class RegisterForm extends Model
{
    public $username;
    public $password;
    public $password_repeat;

    public function rules()
    {
        return [
            [['username', 'password', 'password_repeat'], 'required'],
            ['password', 'string', 'min' => 8, 'max' => 255],
            ['password_repeat', 'compare', 'compareAttribute' => 'password']
        ];
    }

    public function register()
    {
        $value = $this->curlPostRequest();

        if ($value['status']) {
            return true;
        }

        return false;
    }

    //this logic should be moved to a service CurlRequest class
    private function curlPostRequest()
    {
        $postData = [
            'username' => $this->username,
            'password' => Yii::$app->security->generatePasswordHash($this->password)
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,'http://storage_api:4000/api/users');
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        $value = json_decode($response, true);

        curl_close($curl);

        return $value;
    }
}