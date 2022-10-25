UBUNTU_INVENTORY_FILE=ansible/inventory.ini
UBUNTU_ROLES=ansible/roles/main.yml
UBUNTU_USER=root
UBUNTU_HOST=la-service

# Common development
init: docker-build up backend-init frontend-init
up: docker-up
down: docker-down
restart: down up
check-all: check backend-validate-schema
check: backend-php-lint backend-php-cs-fixer backend-php-phpunit backend-php-psalm
backend-init: composer-install backend-wait-db backend-run-migrations backend-load-fixtures backend-permissions
frontend-init: npm-install
check-dependencies: composer-be-updated-all npm-be-updated-all

# Ansible
ping:
	ansible $(UBUNTU_HOST) -i $(UBUNTU_INVENTORY_FILE) -u $(UBUNTU_USER) -m ping
la-service-all:
	ansible-playbook -i $(UBUNTU_INVENTORY_FILE) $(UBUNTU_ROLES) -l $(UBUNTU_HOST) -u $(UBUNTU_USER)
la-service-test:
	ansible-playbook -i $(UBUNTU_INVENTORY_FILE) $(UBUNTU_ROLES) -l $(UBUNTU_HOST) -u $(UBUNTU_USER) -t deploy
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
npm-be-updated-all:
	docker compose run --rm frontend-node-cli npm outdated --depth=9999

# Backend
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
backend-validate-schema:
	docker compose run --rm backend-php-cli composer cli orm:validate-schema
backend-run-migrations:
	docker compose run --rm backend-php-cli composer cli migrations:migrate -- --no-interaction
backend-create-migrations:
	docker compose run --rm backend-php-cli composer cli migrations:diff
backend-wait-db:
	docker compose run --rm backend-php-cli wait-for-it backend-mysql:3306 -t 30
backend-load-fixtures:
	docker compose run --rm backend-php-cli composer cli fixtures:load
backend-permissions:
	docker compose run --rm backend-php-cli chmod 777 var/cache var/log
# Frontend
frontend-build:
	docker compose run --rm frontend-node-cli npm run build
frontend-start:
	docker compose run --rm frontend-node-cli npm run start
frontend-test:
	docker compose run --rm frontend-node-cli npm run test