<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class Rega extends Model
{
    public $login;
    public $password;
    public $password_repeat;
    public $first_name;
    public $last_name;
    public $mail;
    public $patronimyc;
    public $agreed;

    public function rules()
    {
        return [
            [['login', 'mail', 'password', 'first_name', 'last_name', 'patronimyc'], 'required'],
            ['mail', 'email'],
            ['login', 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'login'],
            ['mail', 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'mail'],
            ['password', 'string', 'min' => 6],
            [['first_name', 'last_name'], 'match', 'pattern' => '/^[a-zA-Zа-яА-Я-ёЁ]+$/u'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],
            ['agreed', 'validateAgreed'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateAgreed($attribute, $params)
    {
        if (!$this->agreed) {
            $this->addError($attribute, 'Check box.');
        }
    }

    function signUp() {
            if ($this->agreed) {
                $user = new User();

                $user->login = $this->login;
                $user->mail = $this->mail;
                $user->first_name = $this->first_name;
                $user->last_name = $this->last_name;
                $user->patronimyc = $this->patronimyc;

                $user->setPassword($this->password);

                $user->save();

                return $user->save() ? $user : null;
            }

            $this->addError($this->agreed, 'Вы ОБЯЗАНЫ нажать.');
            return null;
        }
}
