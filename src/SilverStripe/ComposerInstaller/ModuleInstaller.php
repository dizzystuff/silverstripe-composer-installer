<?php
/**
 * @package silverstripe-composer-installer
 */

namespace SilverStripe\ComposerInstaller;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

/**
 * A custom composer installer for installing silverstripe modules, installs
 * them to the base folder.
 *
 * @package silverstripe-composer-installer
 */
class ModuleInstaller extends LibraryInstaller {

	public function supports($type) {
		return $type == 'silverstripe-module' || $type == 'silverstripe-widget';
	}

	public function getInstallPath(PackageInterface $package) {
		$name = $package->getTargetDir()
			? $package->getTargetDir()
			: $package->getName();
		$parts = explode('/', $name);
		$name = end($parts);
		if (substr($name, 0, 13) === 'silverstripe-') $name = substr($name, 13);
		return $name;
	}

}
