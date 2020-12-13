<?php

namespace App\DataFixtures;

use App\Service\Slugify;
use Faker;
use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    const EPISODE_COUNT = 10;

    private $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::EPISODE_COUNT; $i++) {

            $faker  =  Faker\Factory::create('fr_FR');
            $episode = new Episode();
            $episode->setTitle(($faker->title));
            $slug = $this->slugify->slug($episode->getTitle());
            $episode->setSlug($slug);
            $episode->setNumber($faker->numberBetween(1, 5));
            $episode->setSynopsis($faker->text);
            $episode->setSeason($this->getReference('season_' . rand(0, SeasonFixtures::SEASONS_COUNT-1)));
            $manager->persist($episode);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [SeasonFixtures::class];
    }
}
