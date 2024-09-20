<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const SERIES = 10;
    const PROGRAMS = [
        [
            'title' => '24h Chrono',
            'synopsis' => 'Jack Bauer doit encore une fois sauver les US en 24 épisodes',
            'category' => 'category_Action',    
        ],
        [
            'title' => 'Vikings',
            'synopsis' => 'Ragnar et sa joyeuse clique pillent et tuent des gens',
            'category' => 'category_Action',
        ],
        [
            'title' => 'The Boys',
            'synopsis' => 'Des mecs énervés se bagarrent avec des super-héros méchants',
            'category' => 'category_Action',
        ],
        [
            'title' => 'The Shield',
            'synopsis' => 'Un flic pas très clean fait des trucs pas très légaux',
            'category' => 'category_Action',
        ],
        [
            'title' => 'Arrow',
            'synopsis' => 'Robin des Bois, mais au milieu des buildings',
            'category' => 'category_Action',
        ],
        [
            'title' => 'Scrubs',
            'synopsis' => 'Des amis passent leur temps à l\'hôpital',
            'category' => 'category_Humour',
        ],
            [
                'title' => 'Community',
                'synopsis' => 'La fac la plus cool et les étudiants les plus dysfonctionnels',
                'category' => 'category_Humour',
            ],
            [
                'title' => 'Rick & Morty',
                'synopsis' => 'Pickle Riiick !',
                'category' => 'category_Humour',
            ],
            [
                'title' => 'Friends',
                'synopsis' => 'Des amis passent leur temps dans un café',
                'category' => 'category_Humour',
            ],
            [
                'title' => 'How I Met Your Mother',
                'synopsis' => 'Des amis passent leur temps dans un bar',
                'category' => 'category_Humour',
            ],
            [
                'title' => 'Dragon Ball Z',
                'synopsis' => 'KAMEHAMEHAAAAAAAAA',
                'category' => 'category_Animation',
            ],
            [
                'title' => 'Blue Eye Samurai',
                'synopsis' => 'Une samurai tranche des trucs pour se venger',
                'category' => 'category_Animation',
            ],
            [
                'title' => 'Cowboy Bebop',
                'synopsis' => 'L\'espace, une bande son qui déchire, que demande le peuple ?',
                'category' => 'category_Animation',
            ],
            [
                'title' => 'Les aventures de Tintin',
                'synopsis' => 'Il a une houpe, un petit chien, et il aime beaucoup les ennuis',
                'category' => 'category_Animation',
            ],
            [
                'title' => 'Arcane',
                'synopsis' => 'C\'est la bagarre, mais pas dans la faille de l\'invocateur',
                'category' => 'category_Animation',
            ],
            [
                'title' => 'Game of Thrones',
                'synopsis' => 'Une saison, tout un nouveau casting',
                'category' => 'category_Fantastique',
            ],
            [
                'title' => 'Locke & Key',
                'synopsis' => 'Plein de clés, plein d\'ennuis',
                'category' => 'category_Fantastique',
            ],
            [
                'title' => 'Sandman',
                'synopsis' => 'Le seigneur des rêves vit sa petite vie',
                'category' => 'category_Fantastique',
            ],
            [
                'title' => 'Stranger Things',
                'synopsis' => 'Des enfants auraient mieux fait de ne jamais jouer à D&D',
                'category' => 'category_Fantastique',
            ],
            [
                'title' => 'Buffy contre les Vampires',
                'synopsis' => 'Buffy latte des vampires',
                'category' => 'category_Fantastique',
            ],
            [
                'title' => 'American Horror Story',
                'synopsis' => 'Une saison, un endroit horrible',
                'category' => 'category_Horreur',
            ],
            [
                'title' => 'The Walking Dead',
                'synopsis' => 'Les zombies sont là, mais les gens se tuent entre eux',
                'category' => 'category_Horreur',
            ],

            [
                'title' => 'Les Contes de la Crypte',
                'synopsis' => 'L\'horreur du bon vieux temps',
                'category' => 'category_Horreur',
            ],
            [
                'title' => 'La Quatrième Dimension',
                'synopsis' => 'A quand la cinquième dimension ?',
                'category' => 'category_Horreur',
            ],
            [
                'title' => 'Kingdom',
                'synopsis' => 'Des zombies en Corée',
                'category' => 'category_Horreur',
            ],
        ];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i = 1; $i <= self::SERIES; $i++) {
            $program = new Program();
            $program->setTitle($faker->words(3, true));
            $program->setSynopsis($faker->paragraphs(2, true));
            $program->setCategory($this->getReference('category_' . $faker->numberBetween(1, 5)));
            
            $manager->persist($program);
            $this->addReference('program_' . $i, $program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
