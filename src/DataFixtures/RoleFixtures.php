<?php

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class RoleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $roleList = [
            Role::NO_JUMP => 'Без прыжка',
            Role::SINGLETON => 'Самостоятельный',
            Role::TANDEM_CLIENT => 'Тандем пассажир',
            Role::AFF_CLIENT => 'Студент АФФ',
            Role::WS_USER => 'Вингсьют',
            Role::RW_USER => 'Групповая акробатика',
            Role::FF_USER => 'Фрифлай',
            Role::RW_COACH => 'Инструктор RW',
            Role::FF_COACH => 'Инструктор FF',
            Role::WS_COACH => 'Инструктор WS',
            Role::RW_LOT => 'Лот организатор RW',
            Role::FF_LOT => 'Лот организатор FF',
            Role::WS_LOT => 'Лот организатор WS',
            Role::TANDEM_MASTER => 'Тандем мастер',
            Role::AFF_FIRST => 'АФФ основной',
            Role::AFF_SECOND => 'АФФ резервный',
            Role::OPERATOR => 'Оператор',
        ];
        foreach ($roleList as $key => $roleName) {
            $role = new Role();
            $role->setId($key)->setName($roleName);
            $manager->persist($role);
            $manager->flush();
        }

    }
}
