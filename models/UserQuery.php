<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UserBase]].
 *
 * @see UserBase
 */
class UserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
