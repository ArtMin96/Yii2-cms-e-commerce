<?php


namespace common\models\query;


use common\components\Helper;
use yii\db\ActiveQuery;

class UserQuery extends ActiveQuery
{

    /**
     * @return UserQuery
     */
    public function active()
    {
        return $this->andWhere(['status' => 10]);
    }

    /**
     * @return UserQuery
     */
    public function inactive()
    {
        return $this->andWhere(['status' => 9]);
    }

    /**
     * @return UserQuery
     */
    public function deleted()
    {
        return $this->andWhere(['status' => 8]);
    }

    /**
     * @param $usernameOrEmail
     * @return UserQuery
     */
    public function whereUsernameOrEmail($usernameOrEmail) {
        return filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL)
            ? $this->whereEmail($usernameOrEmail)
            : $this->whereUsername($usernameOrEmail);
    }

    /**
     * @param $email
     * @return UserQuery
     */
    public function whereEmail($email) {
        return $this->andWhere(['email' => $email]);
    }

    /**
     * @param $username
     * @return UserQuery
     */
    public function whereUsername($username) {
        return $this->andWhere(['username' => $username]);
    }

    /**
     * @param $id
     * @return UserQuery
     */
    public function whereId($id) {
        return $this->andWhere(['id' => $id]);
    }

    /**
     * @param $id
     * @return UserQuery
     */
    public function whereNotId($id) {
        return $this->andWhere(['<>', 'id', $id]);
    }

    public function ip() {
        return $this->andWhere(['=', 'ip', Helper::RealIP()]);
    }

}