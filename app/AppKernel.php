<?php

use Colli\ConsultasBundle\ConsultasBundle;
use Colli\ControlBundle\ColliControlBundle;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle;
use Symfony\Bundle\DebugBundle\DebugBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\MonologBundle\MonologBundle;
use Symfony\Bundle\SecurityBundle\SecurityBundle;
use Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Bundle\WebProfilerBundle\WebProfilerBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class AppKernel extends Kernel {

  public function registerBundles() {
    $bundles = array(
        new FrameworkBundle(),
        new SecurityBundle(),
        new TwigBundle(),
        new MonologBundle(),
        new SwiftmailerBundle(),
        new DoctrineBundle(),
        new SensioFrameworkExtraBundle(),
        new ColliControlBundle(),
        new Propel\PropelBundle\PropelBundle(),
        new ConsultasBundle(),
        new WhiteOctober\TCPDFBundle\WhiteOctoberTCPDFBundle(),
    );

    if (in_array($this->getEnvironment(), array('dev', 'test'), true)) {
      $bundles[] = new DebugBundle();
      $bundles[] = new WebProfilerBundle();
      $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
      $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
    }

    return $bundles;
  }

  public function registerContainerConfiguration(LoaderInterface $loader) {
    $loader->load($this->getRootDir() . '/config/config_' . $this->getEnvironment() . '.yml');
  }

}
