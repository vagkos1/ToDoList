<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Genus;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;


class LoadFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        Fixtures::load(
            __DIR__.'/fixtures.yml',
            $manager,
            [
                'providers' => [$this]
            ]
        );
    }

    public function task()
    {
        $tasks = [
            'WashClothes',
            'StudyPHP7.3',
            'WriteAHelloWorldIn10Languages',
            'StudyDesignPatternsBeyondSingleton',
            'GoToTheGym',
            'FinishTheSurelyTest',
            'TidyUpTheRoom',
        ];

        $key = array_rand($tasks);

        return $tasks[$key];
    }

    public function category()
    {
        $categories = [
            'Programming',
            'Home',
            'Wellness',
            'Outside',
        ];

        $key = array_rand($categories);

        return $categories[$key];
    }
}
