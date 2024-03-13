<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Lego;

#[AsCommand(
    name: 'app:populate-database',
    description: 'Add a short description for your command',
)]
class PopulateDatabaseCommand extends Command
{
    private EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('File', InputArgument::REQUIRED, 'Argument description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $file = $input->getArgument('File');

        // Chargement du contenu du fichier data.json
        $jsonData = file_get_contents(__DIR__ . '/../Data/' . $file);
        $data = json_decode($jsonData, true);

        // Création des objets Lego à partir des données
        foreach ($data as $legoData) {
            $lego = new Lego($legoData['id']);
            $lego->setName($legoData['name']);
            $lego->setCollection($legoData['collection']);
            $lego->setDescription($legoData['description']);
            $lego->setPrice($legoData['price']);
            $lego->setPieces($legoData['pieces']);
            $lego->setImageBox($legoData['images']['box']);
            $lego->setImageLego($legoData['images']['bg']);

            $this->entityManager->persist($lego);
            $this->entityManager->flush();

        }

        return Command::SUCCESS;
    }
}
