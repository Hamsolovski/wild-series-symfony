<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

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
        foreach(self::EPISODES as $key => $current) 
        {
            $episode = new Episode();
            $episode->setTitle($current['title']);
            $episode->setSynopsis($current['synopsis']);
            $episode->setNumber($current['number']);
            $episode->setSeason($this->getReference('season1_Arcane'));
            $manager->persist($episode);
            
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