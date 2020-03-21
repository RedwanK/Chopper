<?php

namespace App\Controller;

use App\Repository\ActivitiesRepository;
use App\Repository\ProjectRepository;
use App\Repository\SkillsRepository;
use App\Services\FilenameResolverService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends abstractController
{
    /**
     * @var ProjectRepository
     */
    private $projectRepo;
    /**
     * @var ActivitiesRepository
     */
    private $activitiesRepo;
    /**
     * @var SkillsRepository
     */
    private $skillsRepo;
    /**
     * @var FilenameResolverService
     */
    private $filenameResolver;

    public function __construct(ProjectRepository $projectRepository, ActivitiesRepository $activitiesRepository, SkillsRepository $skillsRepository, FilenameResolverService $filenameResolverService)
    {
        $this->projectRepo = $projectRepository;
        $this->activitiesRepo = $activitiesRepository;
        $this->skillsRepo = $skillsRepository;
        $this->filenameResolver = $filenameResolverService;
    }

    /**
     * @Route("/", name="home")
     */
    public function index() {
        $data = $this->getHomepageItems();

        return $this->render("Home/index.html.twig", [
            'projects' => $data['projects'],
            'activities' => $data['activities'],
            'skills' => $data['skills']
        ]);
    }

    private function getHomepageItems() {
        $projects = $this->projectRepo->findAll();

        $activities = $this->activitiesRepo->findAll();

        $skills = $this->skillsRepo->findAll();

        return [
            'projects' => $projects,
            'activities' => $activities,
            'skills' => $skills
        ];
    }
}
