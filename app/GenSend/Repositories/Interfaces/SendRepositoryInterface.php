<?php namespace GenSend\Repositories\Interfaces;

/**
 * Interface SendRepositoryInterface
 * @package GenSend\Repositories\Interfaces
 */
/**
 * Interface SendRepositoryInterface
 * @package GenSend\Repositories\Interfaces
 */
interface SendRepositoryInterface {
    /**
     * @param array $input
     * @return mixed
     */
    public function create(array $input);

    /**
     * @param $url
     * @return mixed
     */
    public function getByUrl($url);

    /**
     * @param $entityId
     * @return mixed
     */
    public function setAsViewed($entityId);

    /**
     * @param $entityId
     * @return mixed
     */
    public function delete($entityId);

    /**
     * @return mixed
     */
    public function deleteOutOfDateRecords();
}