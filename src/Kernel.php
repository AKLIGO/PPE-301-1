<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Vich\UploaderBundle\VichUploaderBundle;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    /**
     * registerBundles
     *
     * @return array
    
    public function registerBundles()
    {
        $this->bundles = [
            new VichUploaderBundle()
        ];
        return  $this->bundles;
    }
     */
}
