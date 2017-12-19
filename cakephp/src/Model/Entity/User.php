<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $userid
 * @property string $name
 * @property string $nickname
 * @property string $mail
 * @property bool $private
 * @property string $password
 * @property \Cake\I18n\FrozenTime $registered_at
 * @property \Cake\I18n\FrozenTime $modified_at
 *
 * @property \App\Model\Entity\DidAt[] $did_at
 * @property \App\Model\Entity\Password[] $passwords
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'userid' => true,
        'name' => true,
        'nickname' => true,
        'mail' => true,
        'private' => true,
        'password' => true,
        'registered_at' => true,
        'modified_at' => true,
        'did_at' => true,
        'passwords' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
 
    /**
     * パスワード保存時のハッシュ化
     * @param  string $password パスワード文字列
     * @return string           ハッシュ化されたパスワード
     */
    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }

}
