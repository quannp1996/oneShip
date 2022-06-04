<?php

namespace App\Ship\core\Traits\HelpersTraits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Class VersionableTrait
 * @package Mpociot\Versionable
 */
trait VersionableTrait
{
  /**
   * Retrieve, if exists, the property that define that Version model.
   * If no property defined, use the default Version model.
   *
   * Trait cannot share properties whth their class !
   * http://php.net/manual/en/language.oop5.traits.php
   * @return unknown|string
   */
  protected function getVersionClass()
  {
    if (property_exists(self::class, 'versionClass')) {
      return $this->versionClass;
    }
    return config('versionable.version_model', Version::class);
  }

  /**
   * Private variable to detect if this is an update
   * or an insert
   * @var bool
   */
  private $updating;

  /**
   * Contains all dirty data that is valid for versioning
   *
   * @var array
   */
  private $versionableDirtyData;

  /**
   * Optional reason, why this version was created
   * @var string
   */
  private $reason;

  /**
   * Flag that determines if the model allows versioning at all
   * @var bool
   */
  protected $versioningEnabled = true;

  /**
   * @return $this
   */
  public function enableVersioning()
  {
    $this->versioningEnabled = true;
    return $this;
  }

  /**
   * @return $this
   */
  public function disableVersioning()
  {
    $this->versioningEnabled = false;
    return $this;
  }

  /**
   * Attribute mutator for "reason"
   * Prevent "reason" to become a database attribute of model
   *
   * @param string $value
   */
  public function setReasonAttribute($value)
  {
    $this->reason = $value;
  }

  /**
   * Initialize model events
   */
  public static function bootVersionableTrait()
  {
    static::saving(function ($model) {
      $model->versionablePreSave();
    });

    // static::saved(function ($model) {
    //   $model->versionablePostSave();
    // });
  }

  /**
   * Return all versions of the model
   * @return MorphMany
   */
  public function versions()
  {
    $class = $this->getVersionClass();
    return $this->morphMany($this->getVersionClass(), 'versionable')->orderBy($class::CREATED_AT, 'DESC');
  }

  /**
   * Returns the latest version available
   * @return Version
   */
  public function currentVersion()
  {
    $class = $this->getVersionClass();
    return $this->versions()->orderBy($class::CREATED_AT, 'DESC')->first();
  }

  /**
   * Returns the previous version
   * @return Version
   */
  public function previousVersion()
  {
    $class = $this->getVersionClass();
    return $this->versions()->latest()->limit(1)->offset(1)->first();
  }

  public function getPrevModel() {
    $preVer = $this->previousVersion();
    if ($preVer) {
      $preVer->load('versionDetails');
      $versionDetails = $preVer->versionDetails;

      $model = $preVer->getModel();

      if  ($versionDetails->isNotEmpty()) {
        $versionDetails = $versionDetails->toArray();
        $loadsRelate = [];

        foreach ($versionDetails as $detail) {
          $loadsRelate[$detail['rela_name']][] = $detail['rela_id'];
        }

        if (!empty($loadsRelate)) {
          foreach ($loadsRelate as $relaName => $relaValueIds) {
            $model->load([
              $relaName => function ($query) use ($relaValueIds) {
                $query->whereIn('id', $relaValueIds);
              }
            ]);
          }
        }
      }

      return $model;
    }

    return null;
  }

  /**
   * Get a model based on the version id
   *
   * @param $version_id
   *
   * @return $this|null <Trả về Model|null>
   */
  public function getVersionModel($version_id)
  {
    $version = $this->versions()->with('versionDetails')->where("version_id", "=", $version_id)->first();
    if (!is_null($version)) {
      $versionDetails = $version->versionDetails->toArray();
      $loadsRelate = [];
      foreach ($versionDetails as $detail) {
        $loadsRelate[$detail['rela_name']][] = $detail['rela_id'];
      }
      $modelVersion = $version->getModel();
      if (!empty($loadsRelate)) {
        foreach ($loadsRelate as $relaName => $relaValueIds) {
          $modelVersion->load([
            $relaName => function ($query) use ($relaValueIds) {
              $query->whereIn('id', $relaValueIds);
            }
          ]);
        }
      }

      return $modelVersion;
    }
    return null;
  }

  /**
   * Pre save hook to determine if versioning is enabled and if we're updating
   * the model
   * @return void
   */
  protected function versionablePreSave()
  {
    if ($this->versioningEnabled === true) {
      $this->versionableDirtyData = $this->getDirty();
      $this->updating             = $this->exists;
    }
  }

  /**
   * Save a new version.
   * @return void
   */
  public function versionablePostSave($params=[])
  {
    /**
     * We'll save new versions on updating and first creation
     */
    if (
      $this->versioningEnabled === true
      //($this->versioningEnabled === true && $this->updating && $this->isValidForVersioning()) ||
     // ($this->versioningEnabled === true && !$this->updating && !is_null($this->versionableDirtyData) && count($this->versionableDirtyData))
    ) {
      // Save a new version
      $class                     = $this->getVersionClass();
      $version                   = new $class();
      $version->versionable_id   = $this->getKey();
      $version->versionable_type = get_class($this);
      $version->user_id          = $this->getAuthUserId();
      $version->model_data       = serialize($this->attributesToArray());

      if (!empty($this->reason)) {
        $version->reason = $this->reason;
      }

      $version->save();

      $this->saveRelateVersion($this->getRelations(), $version);
      $this->purgeOldVersions();
    }
  }

  public function saveRelateVersion(array $relationships=[], $version) {
    $versionDetailArray = [];
    foreach ($relationships as $relaName => $relaInstance) {

      if ($relaInstance) {
        if ($relaInstance instanceof Collection) {
          if ($relaInstance->isNotEmpty()) {
            foreach ($relaInstance as $k => $model) {
              $versionDetailArray[] = [
                'rela_name' => $relaName,
                'rela_model' => get_class($model),
                'rela_id' => $model->id,
              ];
            }
          }
        }else {
          $versionDetailArray[] = [
            'rela_name' => $relaName,
            'rela_model' => get_class($relaInstance),
            'rela_id' => $relaInstance->id
          ];
        }
      }
    }

    return $version->versionDetails()->createMany($versionDetailArray);
  }

  /**
   * Delete old versions of this model when the reach a specific count.
   *
   * @return void
   */
  private function purgeOldVersions()
  {
    $keep = isset($this->keepOldVersions) ? $this->keepOldVersions : 0;

    if ((int)$keep > 0) {
      $count = $this->versions()->count();

      if ($count > $keep) {
        $oldVersions = $this->versions()
          ->latest()
          ->take($count)
          ->skip($keep)
          ->get()
          ->each(function ($version) {
            $version->delete();
          });
      }
    }
  }

  /**
   * Determine if a new version should be created for this model.
   *
   * @return bool
   */
  private function isValidForVersioning()
  {
    $dontVersionFields = isset($this->dontVersionFields) ? $this->dontVersionFields : [];
    $removeableKeys    = array_merge($dontVersionFields, [$this->getUpdatedAtColumn()]);

    if (method_exists($this, 'getDeletedAtColumn')) {
      $removeableKeys[] = $this->getDeletedAtColumn();
    }

    return (count(array_diff_key($this->versionableDirtyData, array_flip($removeableKeys))) > 0);
  }

  /**
   * @return int|null
   */
  protected function getAuthUserId()
  {
    if (Auth::check()) {
      return Auth::id();
    }
    return null;
  }
} // End class
