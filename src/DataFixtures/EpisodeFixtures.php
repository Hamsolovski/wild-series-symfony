<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    const EPISODES = [
        [
            'title' => 'Welcome to the Playground',
            'synopsis' => 'Les sœurs orphelines Vi et Powder causent des remous dans les rues souterraines de Zaun à la suite d\'un braquage dans le très huppé Piltover. ',
            'number' => 1,
        ],
        [
            'title' => 'Certains mystères ne devraient jamais être résolus',
            'synopsis' => 'Idéaliste, le chercheur Jayce tente de maîtriser la magie par la science malgré les avertissements de son mentor. Le criminel Silco teste une substance puissante.',
            'number' => 2,
        ],
        [
            'title' => 'Cette violence crasse nécessaire au changement',
            'synopsis' => 'Deux anciens rivaux s\'affrontent lors d\'un défi spectaculaire qui se révèle fatidique pour Zaun. Jayce et Viktor prennent de gros risques pour leurs recherches.',
            'number' => 3,
        ],
    ];
    
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 1; $i <= ProgramFixtures::SERIES; $i++) {
            for ($j = 1; $j <= 5; $j++) {
                for ($k = 1; $k <= 10; $k++) {
                    $episode = new Episode();
                    $episode->setTitle($faker->words($faker->numberBetween(1, 5), true));
                    $episode->setSynopsis($faker->paragraph(1, true));
                    $episode->setNumber($k);
                    $episode->setSeason($this->getReference('p' . $i . '_season_' . $j));
                    $manager->persist($episode);
                }
            }
        }
        $manager->flush();    
    }

    public function getDependencies()
    {
        return [
            SeasonFixtures::class,
        ];
    }
}