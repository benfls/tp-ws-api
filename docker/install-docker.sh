#!/bin/bash

if [ `id -u` -ne 0 ] ;
  then echo "Please run this script with root privileges"
  exit 1
fi

# source : https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-20-04

apt-get update

apt-get remove docker docker-engine docker.io containerd runc
# Next, install a few prerequisite packages which let apt use packages over HTTPS:
apt-get install apt-transport-https ca-certificates curl gnupg lsb-release software-properties-common -y
# Then add the GPG key for the official Docker repository to your system:
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
# Add the Docker repository to APT sources:
add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable"
# This will also update our package database with the Docker packages from the newly added repo.
# Make sure you are about to install from the Docker repo instead of the default Ubuntu repo:
apt-get install docker-ce docker-ce-cli containerd.io docker-compose -y

usermod -aG docker $USER
newgrp docker
# set for elasticsearch
sysctl -w vm.max_map_count=262144
# set for redis
sysctl vm.overcommit_memory=1

# test docker
docker run hello-world
