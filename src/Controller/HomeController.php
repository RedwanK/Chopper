<?php

namespace App\Controller;

use App\Repository\ActivitiesRepository;
use App\Repository\ProjectRepository;
use App\Repository\SkillsRepository;
use App\Services\FilenameResolverService;
use Doctrine\Common\Collections\ArrayCollection;
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

    private $projectFilters;

    public function __construct(ProjectRepository $projectRepository, ActivitiesRepository $activitiesRepository, SkillsRepository $skillsRepository, FilenameResolverService $filenameResolverService)
    {
        $this->projectRepo = $projectRepository;
        $this->activitiesRepo = $activitiesRepository;
        $this->skillsRepo = $skillsRepository;
        $this->filenameResolver = $filenameResolverService;
        $this->projectFilters = [] ;
    }

    /**
     * @Route("/", name="home")
     */
    public function index() {
        $data = $this->getHomepageItems();

        return $this->render("Home/index.html.twig", $data);
    }

    private function getHomepageItems() {
        $projects = $this->projectRepo->findAll();

        $activities = $this->activitiesRepo->findAll();

        $skills = $this->skillsRepo->findAll();

        $projectFilters = $this->getProjectFilters($projects);

        return [
            'projects' => $projects,
            'activities' => $activities,
            'skills' => $skills,
            'projectFilters' => $projectFilters
        ];
    }

    private function getProjectFilters($projects) {
        foreach ($projects as $project) {
            foreach ($project->getTechnologies() as $techno) {
                if(!array_search($techno, $this->projectFilters, true)) {
                    $this->projectFilters[] = $techno;
                }
            }
        }

        return $this->projectFilters;
    }
}
