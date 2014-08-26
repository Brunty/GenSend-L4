<?php

/**
 * @property mixed expiration_views
 */
class Securesend extends Eloquent {

    /**
     * @var array
     */
    protected $dates = array('expiration_date');

    /**
     * @param bool $url
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function getByUrl($url = false) {
        return $this->whereRaw('BINARY url = ?', [$url])->firstOrFail();
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return bool|mixed
     */
    public function getUrl() {
        return isset($this->url) ? $this->url : false;
    }

    /**
     * @param $value
     * @return string
     */
    public function setPassAttribute($value) {
        $this->attributes['pass'] = Crypt::encrypt($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getPassAttribute($value) {
        return Crypt::decrypt($value);
    }
}