<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for ($i = 1; $i <= ProgramFixtures::SERIES; $i++) {
            for ($j = 1; $j <= 5; $j++) {
                $season = new Season();
                $season->setNumber($j);
                $season->setYear($faker->year());
                $season->setProgram($this->getReference('program_' . $i));
                $season->setDescription($faker->paragraph(1, true));
                $manager->persist($season);
                $this->addReference('p' . $i . '_season_' . $j, $season);
            }
        }
        
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class,
        ];
    }

}