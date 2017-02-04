<?php

namespace Todo\Application\Task;

use Todo\Domain\Exception\TaskNotFoundException;
use Todo\Domain\Repository\TaskRepositoryInterface;
use Todo\Domain\Task;

/**
 * Class Query
 *
 * @category None
 * @package  Todo\Application\Task
 * @author   Martin Pham <i@martinpham.com>
 * @license  None http://
 * @link     None
 */
class Query
{
    /**
     * Task Repository
     *
     * @var TaskRepositoryInterface
     */
    protected $taskRepository;

    /**
     * Query constructor
     *
     * @param TaskRepositoryInterface $taskRepository Task Repository
     */
    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Get All Remaining Tasks
     *
     * @return array
     */
    public function getAllRemainingTasks() : array
    {
        return $this->taskRepository->findAllByStatus(Task::STATUS_REMAINING);
    }

    /**
     * Get All Completed Tasks
     *
     * @return array
     */
    public function getAllCompletedTasks() : array
    {
        return $this->taskRepository->findAllByStatus(Task::STATUS_COMPLETED);
    }

    /**
     * Get Task By Id
     *
     * @param string $taskId Task ID
     *
     * @return Task
     * @throws TaskNotFoundException
     */
    public function getTaskById($taskId) : Task
    {
        try {
            $task = $this->taskRepository->find($taskId);
        } catch (TaskNotFoundException $e) {
            throw $e;
        }

        return $task;
    }
}