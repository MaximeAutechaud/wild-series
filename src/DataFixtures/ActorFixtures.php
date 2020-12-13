<?php


namespace App\DataFixtures;

use App\Entity\Actor;
use Faker;
use App\Entity\Program;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Self_;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    const ACTORS = [
        'Norman Reedus',
        'Bruce Willis' ,
        'Will Smith' ,
        'Brad Pitt' ,
        'Jonathan Kent'
    ];

    public function getDependencies()
    {
        return [ProgramFixtures::class];
        // TODO: Implement getDependencies() method.
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::ACTORS as $name) {
            $actor = new Actor();
            $actor->setName($name);
            $actor->addProgram($this->getReference("program_0"));
            $manager->persist($actor);
        }
        $faker = Faker\Factory::create('fr-FR');
        for ($i=0; $i < 50; $i++) {
            $actor = new Actor();
            $actor->setName($faker->name);
            $actor->addProgram($this->getReference('program_' . rand(0,5)));
            $manager->persist($actor);
        }
        $manager->flush();
        // TODO: Implement load() method.
    }
}