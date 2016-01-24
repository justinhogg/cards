# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant::Config.run do |config|
  config.vm.box     = "trusty32"
  config.vm.box_url = "http://files.vagrantup.com/trusty32.box"

  config.vm.provision :puppet do |puppet|
     puppet.manifests_path = ".puppet/manifests"
     puppet.manifest_file  = "manifest.pp"
     puppet.options        = [ '--verbose' ]
  end
end
