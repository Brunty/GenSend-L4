<?php namespace GenSend\Repositories;
use GenSend\Repositories\Interfaces\SendRepositoryInterface;
use GenSend\Library\Interfaces\Utils\StringInterface as String;
use Crypt;
use Illuminate\Database\QueryException;
use Securesend;
use Carbon\Carbon;

/**
 * Class EloquentSendRepository
 * @package GenSend\Repositories
 */
class EloquentSendRepository extends EloquentRepository implements SendRepositoryInterface {


    /**
     * @param Securesend $securesend
     * @param \GenSend\Library\Interfaces\Utils\StringInterface|String $string
     */
    function __construct(Securesend $securesend, String $string)
    {
        $this->entity = $securesend;
        $this->stringUtility = $string;
    }

    /**
     * @param array $input  Data to create the entry in the securesend table
     * @return bool|Securesend
     */
    public function create(array $input = array()) {
        // to avoid this try-catch block, we could set the URL in the controller by generating it and then use Laravels validation to check that it's unique as well
        try {
            $this->entity->expiration_views = $input['views'];
            $this->entity->expiration_date = Carbon::now()->addDays($input['days']);
            $this->entity->url = $this->stringUtility->randomString(); // very very very slim chance this could generate a string the same as another entry...
            $this->entity->pass = $input['password'];
            $this->entity->save();
            return $this->entity;
        }
        catch(QueryException $e) { // if for some reason we catch a query exception, then we may have a duplicate URL - see comments above
            return false;
        }
    }

    /**
     * @param $url
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function getByUrl($url) {
        return $this->entity->getByUrl($url);
    }

    /**
     * @param $entityId
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|static
     */
    public function setAsViewed($entityId) {
        $entity = $this->entity->findOrFail($entityId);

        $entity->expiration_views = $entity->expiration_views - 1;
        $entity->save();
 
        if($entity->expiration_views == 0) { // if the entity has no more views left, delete it!
            $this->delete($entity->id);
        }

        return $entity;
    }

    /**
     * @param $entityId
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|static
     */
    public function delete($entityId) {
        $entity = $this->entity->findOrFail($entityId);

        $tempEntity = $entity; // used so we can return the original item even after deletion

        // first, write-over the old password with some gibberish
        $entity->pass = Crypt::encrypt($this->stringUtility->randomString(64));
        // now re-save it
        $entity->save();
        // now delete it
        $entity->delete();

        return $tempEntity;
    }

    /**
     * @return bool|int|null
     */
    public function deleteOutOfDateRecords() {
        return $this->entity->where('expiration_date', '<=', Carbon::now())->delete();
    }
}