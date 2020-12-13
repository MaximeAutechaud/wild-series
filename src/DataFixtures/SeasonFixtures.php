<?php


namespace App\DataFixtures;

use Faker;
use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    const SEASONS_COUNT = 7;
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::SEASONS_COUNT; $i++) {

            $faker  =  Faker\Factory::create('fr_FR');
            $season = new Season();
            $season->setNumber($i+1);
            $season->setDescription($faker->text);
            $season->setYear(intval($faker->dateTimeThisDecade()->format('Y')));
            $season->setProgram($this->getReference('program_' . rand(0, count(ProgramFixtures::PROGRAMS)-1)));
            $manager->persist($season);
            $this->addReference('season_' . $i, $season);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [ProgramFixtures::class];
    }
}