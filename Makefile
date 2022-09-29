UBUNTU_INVENTORY_FILE=ansible/inventory.ini
UBUNTU_ROLES=ansible/roles/main.yml
UBUNTU_USER=root
UBUNTU_HOST=la-service

# Common development
init: docker-build up backend-init
up: docker-up
down: docker-down
restart: down up
check: backend-php-lint backend-php-cs-fixer backend-php-phpunit backend-php-psalm
backend-init: composer-install
# frontend-init:

# Ansible
ping:
	ansible $(UBUNTU_HOST) -i $(UBUNTU_INVENTORY_FILE) -u $(UBUNTU_USER) -m ping
la-service-all:
	ansible-playbook -i $(UBUNTU_INVENTORY_FILE) $(UBUNTU_ROLES) -l $(UBUNTU_HOST) -u $(UBUNTU_USER)

# Docker
docker-build:
	docker compose build --pull
docker-up:
	docker compose up -d
docker-down:
	docker compose down --remove-orphans

# Composer
composer-install:
	docker compose run --rm backend-php-cli composer install
composer-be-updated:
	docker compose run --rm backend-php-cli composer outdated --direct
composer-be-updated-all:
	docker compose run --rm backend-php-cli composer show -l -o

# Npm
npm-install:
	docker compose run --rm frontend-node-cli npm install

# Libraries
backend-php-lint:
	docker compose run --rm backend-php-cli composer phplint
backend-php-phpunit:
	docker compose run --rm backend-php-cli composer phpunit
backend-php-cs-fixer-dry-run:
	docker compose run --rm backend-php-cli composer php-cs-fixer fix -- --dry-run --diff
backend-php-cs-fixer:
	docker compose run --rm backend-php-cli composer php-cs-fixer fix
backend-php-psalm:
	docker compose run --rm backend-php-cli composer psalm