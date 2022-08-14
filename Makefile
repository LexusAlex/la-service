UBUNTU_INVENTORY_FILE=ansible/inventory.ini
UBUNTU_ROLES=ansible/roles/main.yml
UBUNTU_USER=root
UBUNTU_HOST=la-service

# Ansible
ping:
	ansible $(UBUNTU_HOST) -i $(UBUNTU_INVENTORY_FILE) -u $(UBUNTU_USER) -m ping
la-service-all:
	ansible-playbook -i $(UBUNTU_INVENTORY_FILE) $(UBUNTU_ROLES) -l $(UBUNTU_HOST) -u $(UBUNTU_USER)
deploy:
	ssh -o StrictHostKeyChecking=no deploy@${HOST} -p ${PORT} '!!!command!!!'

# Docker
docker-build:
	docker compose build --pull
docker-up:
	docker compose up -d
docker-down:
	docker compose down --remove-orphans