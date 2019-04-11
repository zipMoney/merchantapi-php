#!/bin/sh

##########################################################
## Pre-deployment Shell Script
##########################################################

# get release version
RELEASE_VERSION_NUMBER=$(cat composer.json | grep version | head -1 | awk -F: '{ print $2 }' | sed 's/[ ",]//g');
RELEASE_VERSION="v${RELEASE_VERSION_NUMBER}"

# Add release tag
git tag -a ${RELEASE_VERSION} -m "Releasing version ${RELEASE_VERSION}"
git push origin ${RELEASE_VERSION}

# create release branch
git branch release/${RELEASE_VERSION_NUMBER}
git push origin release/${RELEASE_VERSION_NUMBER}

##########################################################
## Deploy code to the Github
##########################################################

GITHUB_REPO="https://github.com/zipMoney/merchantapi-php.git"

# curl -u ${GITHUB_USERNAME}:${GITHUB_ACCESS_TOKEN} https://api.github.com/user
git remote add github ${GITHUB_REPO}
git push github master
git push github release/${RELEASE_VERSION_NUMBER}
git push --tags github
