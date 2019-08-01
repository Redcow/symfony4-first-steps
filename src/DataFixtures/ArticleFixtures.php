<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Article;
use Faker\Factory;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        // Création de 3 catégories fakées
        for($i= 0; $i < 3; $i++)
        {
            $category = new Category();
            $category->setTitle($faker->sentence())
                     ->setDescription($faker->paragraph());

            $manager->persist($category);

            // Créer 4 à 6 articles
            for($j = 0; $j < mt_rand(4, 6); $j++)
            {
                $article = new Article();
                $article->setTitle($faker->sentence())
                    ->setContent(join($faker->paragraphs(), '<br>'))
                    ->setImage($faker->imageUrl())
                    ->setCreatedAt($faker->dateTimeBetween('- 6 months'))
                    ->setCategory($category);

                $manager->persist($article);

                $now = new \DateTime();
                $interval = $now->diff($article->getCreatedAt())->days;

                // Créer 2 à 10 commentaires
                for($k = 0; $k < mt_rand(4, 10); $k++)
                {
                    $comment = new Comment();
                    $comment->setAuthor($faker->name)
                            ->setContent(join($faker->paragraphs(2), '<br>'))
                            ->setCreatedAt($faker->dateTimeBetween('- '.$interval.' days'))
                            ->setArticle($article);

                    $manager->persist($comment);
                }
            }
        }

        $manager->flush();
    }
}
