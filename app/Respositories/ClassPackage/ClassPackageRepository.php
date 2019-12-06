<?php

namespace App\Repositories\ClassPackage;

use App\ClassPackage;
use App\Repositories\ClassPackage\ClassPackageInterface as ClassPackageInterface;
class ClassPackageRepository implements ClassPackageInterface
{

	protected $classpackage;

	public function __construct(ClassPackage $classpackage)
	{
	    $this->classpackage = $classpackage;
	}

    public function getPaginate() {
        return $this->classpackage->paginate(10);
    }

}

?>