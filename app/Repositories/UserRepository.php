<?php

namespace App\Repositories;
use App\User;

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 17.12.2020
 * Time: 13:53
 */
class UserRepository
{
    public function getOrCreateUserBySocData(\Laravel\Socialite\Two\User $userData, $socType)
    {
        if ($socType == 'facebook') {
            $name = $userData->getName();
        } elseif ($socType == 'github') {
            $name = $userData->getNickname();
        }

        $user = User::query()
            ->where('id_at_soc', $userData->getId())
            ->where('soc_type', $socType)
            ->first();

        if (empty($user)) {
            $user = User::create([
                'name' => $name,
                'email' => $userData->getEmail(),
                'is_admin' => '0',
                'password' => '',
                'id_at_soc' => $userData->getId(),
                'soc_type' => $socType
            ]);
        }

        return $user;
    }
}