THIS_FILE := $(lastword $(MAKEFILE_LIST))

all: help

coffee:
	@echo "☕  Making some coffee! ☕"
	@$(MAKE) -f $(THIS_FILE) start
	@$(MAKE) -f $(THIS_FILE) install
	@$(MAKE) -f $(THIS_FILE) deps
	@$(MAKE) -f $(THIS_FILE) build
	@echo "☕  Coffee is ready! ☕"

bw:
	@$(MAKE) -f $(THIS_FILE) build
	@$(MAKE) -f $(THIS_FILE) watch

start:
	@bin/tasks/start.sh

install:
	@bin/tasks/install.sh

deps:
	@bin/tasks/deps.sh

clone-staging:
	@bin/tasks/clone-staging.sh

build:
	@bin/tasks/build.sh

build-prod:
	@bin/tasks/build-prod.sh

watch:
	@bin/tasks/watch.sh

test:
	@bin/tasks/test.sh

dev:
	@bin/tasks/dev.sh

ssh:
	@bin/tasks/ssh.sh

ssh-dev:
	@bin/tasks/ssh-dev.sh

ssh-staging:
	@bin/tasks/ssh-staging.sh

ssh-prod:
	@bin/tasks/ssh-prod.sh

rebuild:
	@bin/tasks/rebuild.sh

stop:
	@bin/tasks/stop.sh

restart:
	@bin/tasks/restart.sh

clean:
	@bin/tasks/clean.sh

help:
	@echo "	Welcome to Grizzly WP!"
	@echo ""
	@echo "	make coffee"
	@echo "					- Run start, install, deps, and build"
	@echo ""
	@echo "	make bw"
	@echo "					- Run build and watch"
	@echo ""
	@echo "	make start"
	@echo "					- Start the containers"
	@echo ""
	@echo "	make install"
	@echo "					- Install WordPress inside the container"
	@echo ""
	@echo "	make deps"
	@echo "					- Install project dependencies"
	@echo ""
	@echo "	make clone-staging"
	@echo "					- Clone the staging server to local"
	@echo ""
	@echo "	make dev"
	@echo "					- Connect dev branch to dev server"
	@echo ""
	@echo "	make build"
	@echo "					- Build the project"
	@echo ""
	@echo "	make build-prod"
	@echo "					- Build the project with the production flag"
	@echo ""
	@echo "	make watch"
	@echo "					- Serve the site on port 3000 and watch for changes"
	@echo ""
	@echo "	make test"
	@echo "					- Run all tests excluding acceptance tests"
	@echo ""
	@echo "	make ssh"
	@echo "					- SSH into the container"
	@echo ""
	@echo "	make ssh-dev"
	@echo "					- SSH into the dev server"
	@echo ""
	@echo "	make ssh-staging"
	@echo "					- SSH into the staging-server"
	@echo ""
	@echo "	make ssh-prod"
	@echo "					- SSH into the prod server"
	@echo ""
	@echo "	make rebuild"
	@echo "					- Rebuild and restart the container"
	@echo ""
	@echo "	make stop"
	@echo "					- Stop the container"
	@echo ""
	@echo "	make restart"
	@echo "					- Restart the container"
	@echo ""
	@echo "	make clean"
	@echo "					- Docker garbage collection"

.PHONY: coffee bw start install deps clone-staging build build-prod watch test sync dev ssh ssh-dev ssh-staging ssh-prod rebuild stop restart clean
