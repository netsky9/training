<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "rent".
 *
 * @property integer $id_rent
 * @property integer $id_product
 * @property integer $id_user
 * @property string $rent_begin
 * @property string $rent_end
 */
class Rent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_product', 'id_user', 'message', 'rent_begin', 'rent_end', 'status'], 'required'],
            [['id_product', 'id_user'], 'integer'],
            [['rent_begin', 'rent_end', 'message', 'status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_rent' => 'Id Rent',
            'id_product' => 'Id Product',
            'id_user' => 'Id User',
            'message' => 'Message',
            'rent_begin' => 'Rent Begin',
            'rent_end' => 'Rent End',
            'status' => 'Status',
        ];
    }

    //report
    public function orderRent($pages_offset, $pages_limit, $timeStart, $timeEnd, $title, $user){
        
        $query = "
                SELECT rent.*, products.*, users.username as username
                FROM rent
                INNER JOIN users ON rent.id_user = users.id_user
                INNER JOIN products ON rent.id_product = products.id_product
                WHERE rent.status = 'complete'
                AND rent.rent_begin > :timeStart AND rent.rent_end < :timeEnd
                ";

        $pdo = array(':timeStart' => $timeStart, ':timeEnd' => $timeEnd);
        if($title != null){
            $query .= ' AND products.title_product LIKE :title';
            $pdo += [':title' => '%'.$title.'%'];
        }
        if($user != null){
            $query .= ' AND rent.id_user = :user';
            $pdo += [':user' => $user];
        }
            $query .= ' LIMIT :offset, :limit';
            $pdo += [':offset' => $pages_offset];
            $pdo += [':limit' => $pages_limit];

        $rentReport = Yii::$app->db->createCommand($query, $pdo)->queryAll();

        return $rentReport;
    }

    //report count
    public function orderRentCount($timeStart, $timeEnd, $title, $user){
        
        $query = "
                SELECT rent.*, products.*, COUNT(*) as counter
                FROM rent
                INNER JOIN users ON rent.id_user = users.id_user
                INNER JOIN products ON rent.id_product = products.id_product
                WHERE rent.status = 'complete'
                AND rent.rent_begin > :timeStart AND rent.rent_end < :timeEnd
                ";

        $pdo = array(':timeStart' => $timeStart, ':timeEnd' => $timeEnd);
        if($title != null){
            $query .= ' AND products.title_product LIKE :title';
            $pdo += [':title' => '%'.$title.'%'];
        }
        if($user != null){
            $query .= ' AND rent.id_user = :user';
            $pdo += [':user' => $user];
        }

        $rentReport = Yii::$app->db->createCommand($query, $pdo)->queryAll();

        return $rentReport;
    }
}
