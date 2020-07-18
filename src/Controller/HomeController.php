<?php

namespace App\Controller;

use App\Repository\ActivitiesRepository;
use App\Repository\ProjectRepository;
use App\Repository\SkillsRepository;
use App\Services\FilenameResolverService;
use App\Services\TwitterService;
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
    /**
     * @var TwitterService
     */
    private $twitterService;

    /**
     * HomeController constructor.
     *
     * @param ProjectRepository       $projectRepository
     * @param ActivitiesRepository    $activitiesRepository
     * @param SkillsRepository        $skillsRepository
     * @param FilenameResolverService $filenameResolverService
     * @param TwitterService          $twitterService
     */
    public function __construct(ProjectRepository $projectRepository,
                                   ActivitiesRepository $activitiesRepository,
                                   SkillsRepository $skillsRepository,
                                   FilenameResolverService $filenameResolverService,
                                   TwitterService $twitterService
    )
    {
        $this->projectRepo      = $projectRepository;
        $this->activitiesRepo   = $activitiesRepository;
        $this->skillsRepo       = $skillsRepository;
        $this->filenameResolver = $filenameResolverService;
        $this->projectFilters   = [];
        $this->twitterService   = $twitterService;
    }

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $data = $this->getHomepageItems();

        return $this->render("Home/index.html.twig", $data);
    }

    /**
     * @return array
     */
    private function getHomepageItems()
    {
        $projects = $this->projectRepo->findAll();

        $activities = $this->activitiesRepo->findAll();

        $skills = $this->skillsRepo->findAll();

        $projectFilters = $this->getProjectFilters($projects);

        $tweets = $this->twitterService->getTweets();

        return [
            'projects'       => $projects,
            'activities'     => $activities,
            'skills'         => $skills,
            'projectFilters' => $projectFilters,
            'tweets'         => $tweets
        ];
    }

    /**
     * @param $projects
     *
     * @return array
     */
    private function getProjectFilters($projects)
    {
        foreach ($projects as $project) {
            foreach ($project->getTechnologies() as $techno) {
                if (!array_search($techno, $this->projectFilters, true)) {
                    $this->projectFilters[] = $techno;
                }
            }
        }

        return $this->projectFilters;
    }
}
